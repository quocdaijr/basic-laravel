<?php

use Modules\Post\Constants\PostConstant;

?>

<div class="my-4 text-sm text-center">
    @switch($post->status ?? null)
        @case(\Modules\Post\Constants\PostConstant::STATUS_DRAFT)
            <button type="submit" data-action="publish" name="action" value="publish"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg hover:bg-green-700">
                Publish
            </button>
            <button type="submit" data-action="save" name="action" value="save"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700">
                Save
            </button>
            <button type="submit" data-action="delete" name="action" value="delete"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-red-500 border border-transparent rounded-lg hover:bg-red-700">
                Delete
            </button>
        @break
        @case(\Modules\Post\Constants\PostConstant::STATUS_PUBLISHED)
            <button type="submit" data-action="save" name="action" value="save"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700">
                Save
            </button>
            <button type="submit" data-action="delete" name="action" value="delete"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-red-500 border border-transparent rounded-lg hover:bg-red-700">
                Delete
            </button>
        @break
        @case(\Modules\Post\Constants\PostConstant::STATUS_TRASH)
            <button type="submit" data-action="restore" name="action" value="restore"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-yellow-500 border border-transparent rounded-lg hover:bg-yellow-700">
                Restore
            </button>
            <button type="submit" data-action="save" name="action" value="save"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700">
                Save
            </button>
        @break
        @default
            <button type="submit" data-action="publish" name="action" value="publish"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg hover:bg-green-700">
                Publish
            </button>
            <button type="submit" data-action="save" name="action" value="save"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700">
                Save
            </button>
    @endswitch
</div>
