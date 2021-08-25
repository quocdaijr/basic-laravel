window.data = function () {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'))
        }

        // else return their preferences
        return (
            !!window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        )
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value)
    }

    return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark
            setThemeToLocalStorage(this.dark)
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen
        },
        closeSideMenu() {
            this.isSideMenuOpen = false
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen
        },
        menuName: '',
        isMenuOpen: false,
        toggleMenu(name) {
            if (this.menuName !== name)
                this.isMenuOpen = true
            else
                this.isMenuOpen = !this.isMenuOpen
            this.menuName = name
        },
        // Modal
        isModalOpen: false,
        trapCleanup: null,
        openModal() {
            this.isModalOpen = true
            this.trapCleanup = focusTrap(document.querySelector('#modal'))
        },
        closeModal() {
            this.isModalOpen = false
            this.trapCleanup()
        },
    }
}

window.focusTrap = function (element) {
    const focusableElements = getFocusableElements(element)
    const firstFocusableEl = focusableElements[0]
    const lastFocusableEl = focusableElements[focusableElements.length - 1]

    // Wait for the case the element was not yet rendered
    setTimeout(() => firstFocusableEl.focus(), 50)

    /**
     * Get all focusable elements inside `element`
     * @param {HTMLElement} element - DOM element to focus trap inside
     * @return {HTMLElement[]} List of focusable elements
     */
    function getFocusableElements(element = document) {
        return [
            ...element.querySelectorAll(
                'a, button, details, input, select, textarea, [tabindex]:not([tabindex="-1"])'
            ),
        ].filter((e) => !e.hasAttribute('disabled'))
    }

    function handleKeyDown(e) {
        const TAB = 9
        const isTab = e.key.toLowerCase() === 'tab' || e.keyCode === TAB

        if (!isTab) return

        if (e.shiftKey) {
            if (document.activeElement === firstFocusableEl) {
                lastFocusableEl.focus()
                e.preventDefault()
            }
        } else {
            if (document.activeElement === lastFocusableEl) {
                firstFocusableEl.focus()
                e.preventDefault()
            }
        }
    }

    element.addEventListener('keydown', handleKeyDown)

    return function cleanup() {
        element.removeEventListener('keydown', handleKeyDown)
    }
}

window.str2url = function (str) {
    str = str.toUpperCase();
    str = str.toLowerCase();
    //For Vietnamese Unicode
    str = str.replace(/[\u00E1\u00E0\u1EA1\u00E2\u1EA5\u1EAD\u0103\u1EAF\u1EB7\u1EA7\u1EB1\u1EA3\u00E3\u1EA9\u1EAB\u1EB3\u1EB5]/g, 'a');
    str = str.replace(/[\u00ED\u00EC\u1ECB\u1EC9\u0129]/g, 'i');
    str = str.replace(/[\u00F3\u00F2\u1ECD\u1ECF\u00F5\u00F4\u1ED1\u1ED3\u1ED9\u1ED5\u1ED7\u01A1\u1EDB\u1EDD\u1EE3\u1EDF\u1EE1]/g, 'o');
    str = str.replace(/[\u00FA\u00F9\u1EE5\u1EE7\u0169\u01B0\u1EE9\u1EEB\u1EF1\u1EED\u1EEF]/g, 'u');
    str = str.replace(/[\u0065\u00E9\u00E8\u1EB9\u1EBB\u1EBD\u00EA\u1EBF\u1EC1\u1EC7\u1EC3\u1EC5]/g, 'e');
    str = str.replace(/[\u00FD\u1EF3\u1EF5\u1EF7\u1EF9]/g, 'y');
    str = str.replace(/[\u0111]/g, 'd');
    str = str.replace(/[\u00E7\u0107\u0106]/g, 'c');
    str = str.replace(/[\u0142\u0141]/g, 'l');
    str = str.replace(/[\u015B\u015A]/g, 's');
    str = str.replace(/[\u017C\u017A\u017B\u0179]/g, 'z');
    str = str.replace(/[\u00F1]/g, 'n');
    str = str.replace(/[\u0153]/g, 'oe');
    str = str.replace(/[\u00E6]/g, 'ae');
    str = str.replace(/[\u00DF]/g, 'ss');

    str = str.replace(/[^a-z0-9\s\'\:\/\[\]_]/g, '');
    str = str.replace(/[\s\'\:\/\[\]-]+/g, ' ');
    str = str.replace(/[ ]/g, '-');

    if (str.charAt(str.length - 1) === '-') {
        str = str.substring(0, str.length - 1);
    }

    if (str.charAt(0) === '-') {
        str = str.substring(1, str.length);
    }

    return str;
}

window.copyToInput = function (fromId, toId, type = '') {
    let fromElement = document.getElementById(fromId)
    let toElement = document.getElementById(toId)
    let value = fromElement.value.trim()
    switch (type) {
        case 'slug':
            toElement.value = str2url(value)
            break;
        case 'text':
        default:
            toElement.value = value
            break;
    }
    // if (type === 'slug') {
    //     document.getElementById(fromId).onkeyup = function () {
    //         document.getElementById(toId).value = str2url(document.getElementById(fromId).value.trim())
    //     }
    // }
    // if (type === 'text' || type === '') {
    //     document.getElementById(fromId).onkeyup = function () {
    //         document.getElementById(toId).value = document.getElementById(fromId).value.trim()
    //     }
    // }
    // let fromElement = document.getElementById(fromId);
    // let toElement = document.getElementById(toId);
    // document.getElementById(fromId).onkeyup = function () {
    //     let value = document.getElementById(fromId).value.trim()
    //
    //     // switch (type) {
    //     //     case 'slug':
    //     //         toElement.value = str2url(value)
    //     //     case 'text':
    //     //     default:
    //     //         toElement.value = value
    //     // }
    // }
}

window.alertConfirm = function (form_id,
                                title = 'Are you sure?',
                                text = 'You won\'t be able to revert this!',
                                btn_confirm_text = 'Yes, do it!',
                                btn_cancel_text = 'No, cancel!'
) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: btn_confirm_text,
        cancelButtonText: btn_cancel_text,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(form_id).submit()
        }
    })
}

