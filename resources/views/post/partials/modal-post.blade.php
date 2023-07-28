<!-- Modal-->
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="post-modal-title" role="dialog" aria-modal="true"
    id="postModal" hidden>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="mt-2">
                        <p class="text-lg leading-6 font-medium text-gray-900" id="post-modal-title">Post</p>
                        <p class="text-sm text-gray-500" id="modal-sub-title"></p>
                    </div>
                    {{-- Create and Edit Post Form --}}
                    <form action="" method="" name="postForm" id="postForm" enctype="multipart/form-data"
                        hidden>
                        @csrf
                        <div class="mt-4 w-full flex justify-center items-center" id="shared_post_content"
                            hidden="hidden">
                            <div class="max-w-xl mx-auto border-2 border-gray-200 bg-slate-200 rounded-lg p-3 m-2">
                                <div class="flex items-center w-64 mb-2">
                                    {{-- <h1 id="shared-user-info"></h1> --}}
                                    <h1 id="shared-content" class="text-xs"></h1>
                                </div>
                                <div class="flex justify-center items-center">
                                    <img id="shared-image" src="" class="w-64 h-auto" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 w-full">
                            <div class="w-full">
                                <span class="text-red-600 text-sm post_submit_error"></span>
                                <span class="text-red-600 text-sm error-text post_id_error"></span>
                                <input type="hidden" id="post_id" name="post_id">

                                <textarea name="content" id="content" rows="5" placeholder="Write your thoughts here..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
                                <div class="text-sm text-gray-400" id="character_count"></div>
                                <span class="text-red-600 text-sm error-text content_error"></span>
                            </div>
                        </div>
                        <div class="mt-4" id="image_selection_input" hidden="hidden">
                            <div class="max-w-xl mx-auto">
                                <div class="flex items-center">
                                    <input type="file" name="image" id="image" class="hidden">
                                    <label for="image"
                                        class="image_label text-xs text-slate-800 bg-gray-200 hover:text-slate-100 hover:bg-gray-600 px-4 py-2 rounded-xl cursor-pointer w-full">
                                        <i class="fa-solid fa-upload fa-beat"></i> Upload Image
                                    </label>
                                </div>
                                <span class="text-red-600 text-sm error-text image_error"></span>
                                <div class="flex justify-center items-center">
                                    <img id="preview" src="#" alt="your image" class="h-64 w-auto my-4"
                                        style="display:none;" />
                                </div>
                                <p class="text-xs text-gray-600 px-4 pt-2 mb-4">If you have any images related to your
                                    post, you can upload them here. Images should be with the types jpg, jpeg, png and
                                    svg.
                                    The file size should not exceed 2mb.</p>

                            </div>
                        </div>

                        <div class="px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" id="saveBtn" value="create"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>
                            <button type="button"
                                class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>

                    <div id="delete_post_modal_btn" hidden="hidden">
                        <div class="mt-4 w-full">
                            <span class="text-red-600 text-sm" id="delete_post_error"></span>
                        </div>
                        <div class="px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" id="deletePostBtn" value=""
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:red-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">Delete
                                Post
                            </button>
                            <button type="button"
                                class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
