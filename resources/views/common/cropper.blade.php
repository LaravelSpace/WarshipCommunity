<template id="template-vue-cropper">
    <div class="card border-primary">
        <div class="card-body">
            <div class="modal fade" id="image-cropper" tabindex="-1" role="dialog"
                 aria-labelledby="image-cropper-label" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width:1200px" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="image-cropper-label">图片裁剪</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class=col-md-6>
                                <input id='input-image' type="file" accept="image/jpg,image/jpeg,image/png" hidden/>
                                <div style="max-width:500px; max-height:500px">
                                    <img id="cropper-image" src="">
                                </div>
                            </div>
                            <div class=col-md-6>
                                <div id="result-image" style="max-width:500px; max-height:500px"></div>
                            </div>
                            {{--<p>CropperData: <span id="cropper-data"></span></p>--}}
                            {{--<p>CropperCropBoxData: <span id="cropper-box-data"></span></p>--}}
                        </div>
                        <div class="modal-footer">
                            <button id="btn-choose-image" type="button" class="btn btn-primary">点击选择图片</button>
                            <button type="button" class="btn btn-success" @click="uploadImage()">上传</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="button" class="btn btn-primary" @click="showModal()">点击上传图片</button>
        </div>
    </div>
</template>
<script>
    Vue.component("vue-cropper", {
        template: "#template-vue-cropper",
        data: function () {
            return {
                eBtnChooseImage: Object,
                eInputImage: Object,
                eCropperImage: Object,
                eCropperData: Object,
                eCropperBoxData: Object,
                eResultImage: Object,
                eBtnUploadImage: Object,
                croppedCanvas: Object,
                cropper: Object,
            }
        },
        methods: {
            showModal: function () {
                $('#image-cropper').modal('show');
                this.initModal();
            },
            initModal: function () {
                this.eBtnChooseImage = document.getElementById('btn-choose-image');
                this.eInputImage = document.getElementById('input-image');
                this.eCropperImage = document.getElementById('cropper-image');
                this.eCropperData = document.getElementById('cropper-data');
                this.eCropperBoxData = document.getElementById('cropper-box-data');
                this.eResultImage = document.getElementById('result-image');
                this.eBtnUploadImage = document.getElementById('btn-upload-image');
                this.croppedCanvas = document.createElement('canvas');

                this.eBtnChooseImage.onclick = this.chooseImage;
                this.eInputImage.onchange = this.inputImageChanged;

                let thisVue = this;
                this.cropper = new Cropper(thisVue.eCropperImage, {
                    viewMode: 1,
                    aspectRatio: 1,
                    crop: function (event) {
                        // let tempCropperData = thisVue.cropper.getData();
                        // let tempCropperBoxData = thisVue.cropper.getCropBoxData();
                        // thisVue.eCropperData.textContent = JSON.stringify(tempCropperData);
                        // thisVue.eCropperBoxData.textContent = JSON.stringify(tempCropperBoxData);
                        thisVue.cropImage();
                    },
                });
            },
            chooseImage: function (event) {
                this.eInputImage.click();
            },
            inputImageChanged: function () {
                let imageReader = new FileReader();
                let thisVue = this;
                imageReader.onload = function (event) {
                    thisVue.cropper.replace(event.target.result)
                };
                imageReader.readAsDataURL(thisVue.eInputImage.files[0]);
            },
            cropImage: function (event) {
                let croppedCanvas = this.cropper.getCroppedCanvas();
                croppedCanvas.style.width = '500px';
                croppedCanvas.style.height = '500px';
                this.eResultImage.innerHTML = '';
                this.eResultImage.appendChild(croppedCanvas);
            },
            uploadImage: function (event) {
                let croppedCanvas = this.cropper.getCroppedCanvas();
                let croppedImageBase64 = croppedCanvas.toDataURL('image/jpeg');
                axios.post(URI_API.image + URI_CONFIG.store, {
                    'image_base64': croppedImageBase64
                }).then(function (response) {
                    if (response.data.status === STATUS.success) {

                    }
                });
            }
        }
    });
    new Vue({el: "#vue-cropper"});
</script>
