window.multipleSelect = function multipleSelect(idName) {
    return {
        options: [],
        selected: [],
        show: false,
        open() {
            this.show = true
        },
        close() {
            this.show = false
        },
        isOpen() {
            return this.show === true
        },
        select(index, event) {
            if (!this.options[index].selected) {
                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);
            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }
            this.selectedOptions()
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);
            this.selectedOptions()
        },
        selectedValues() {
            return this.selected.map((option) => {
                return this.options[option].value;
            })
        },
        initOptions(oldValues) {
            const options = document.getElementById(idName).options;
            for (let i = 0; i < options.length; i++) {
                let currentIndex = this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: oldValues.indexOf(parseInt(options[i].value)) !== -1
                }) - 1;
                if (oldValues.indexOf(parseInt(options[i].value)) !== -1) {
                    this.selected.push(currentIndex)
                }
            }
            this.selectedOptions()
        },
        selectedOptions() {
            let values = this.selectedValues();
            document.getElementById(idName).value = null
            let options = Array.from(document.querySelectorAll('#' + idName + ' option'));

            values.forEach(function(v) {
                options.find(c => c.value == v).selected = true
            });
        }
    }
}
