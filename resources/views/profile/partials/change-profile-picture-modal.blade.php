<!-- Change Picture modal-->
<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    id="changePicModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Change Profile Picture
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Picture should be with the types jpg, jpeg, png or gif. The file size should not exceed
                                2mb.
                            </p>
                        </div>

                        <form action="{{ route('profile.updatePicture') }}" method="POST" name="changePictureForm"
                            id="changePictureForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-8">
                                <div class="max-w-xl mx-auto">
                                    <div class="flex justify-center flex-col items-center">
                                        <div class="w-64 h-64 rounded-full overflow-hidden border-2 border-indigo-600"
                                            id="preview-dp-div" style="display:none;">
                                            <img id="image_preview" src="#" alt="Profile Picture"
                                                class="object-cover w-full h-full" />
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="file" name="profile_picture" id="profile_picture"
                                            class="hidden">
                                            <div class="w-64">
                                                <label for="profile_picture"
                                                class="dp_label text-xs bg-gray-200 px-4 py-2 rounded-lg cursor-pointer whitespace-wrap">
                                                Select Image
                                            </label>
                                            </div>
                                     
                                        <span class="text-red-600 text-sm error-text profile_picture_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Update
                                </button>
                                <button type="button"
                                    class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
