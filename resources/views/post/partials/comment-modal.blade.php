<!-- Modal for commenting-->
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="post-modal-title" role="dialog" aria-modal="true"
    id="commentModal" hidden>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="mt-2">
                        <p class="text-lg leading-6 font-medium text-gray-900" id="comment-modal-title"></p>
                        <p class="text-sm text-gray-500" id="comment-sub-title"></p>
                    </div>
                    <form action="" method="POST" name="commentForm" id="commentForm"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- CONTENT OF THE POST YOU WILL BE COMMENTING ON -->
                        <div class="mt-4 w-full flex justify-center items-center" id="comment_post_content">
                            <div class="max-w-xl mx-auto border-2 border-gray-200 bg-slate-200 rounded-lg p-3 m-2">
                                <div class="flex items-center w-64 mb-2">
                                    <h1 id="comment-user-info" class="text-sm bold"></h1>
                                </div>
                                <div class="flex items-center w-64 mb-2">
                                    <h1 id="comment-content" class="text-xs"></h1>
                                </div>
                                <div class="flex justify-center items-center">
                                    <img id="comment-image" src="" class="w-64 h-auto" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 w-full">
                            <div class="w-full">
                                <span class="text-red-600 text-sm" id="edit_comment_error"></span>
                                <input type="text" id="comment_post_id" name="post_id">
                                <span class="text-red-600 text-sm error-text post_id_error"></span>

                                <input type="text" id="comment_id" name="comment_id">
                                <span class="text-red-600 text-sm error-text comment_id_error"></span>

                                <textarea name="comment" id="comment" rows="5" placeholder="Write your thoughts here..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
                                <div class="text-sm text-gray-400" id="comment_character_count"></div>
                                <span class="text-red-600 text-sm error-text comment_error"></span>
                            </div>
                        </div>

                        <!-- BUTTONS FOR THE CREATE/EDIT COMMENT -->
                        <div class="px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" id="saveCommentBtn" value="create"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Submit Comment
                            </button>
                            <button type="button"
                                class="closeModalComment mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>

                    <!-- DELETE COMMENT -->
                    <div id="delete_comment_modal_btn" hidden="hidden">
                        <div class="mt-4 w-full">
                            <span class="text-red-600 text-sm" id="delete_comment_error"></span>
                        </div>
                        <div class="px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">

                            <button type="button" id="deleteCommentBtn" value=""
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:red-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete Comment
                            </button>
                            <button type="button"
                                class="closeModalComment mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
