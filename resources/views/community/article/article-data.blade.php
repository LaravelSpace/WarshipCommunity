<template id="template-article-data">
    <div>
        <div class="form-group">
            <label for="article-title">标题</label>
            <input type="text" class="form-control" id="article-title" :class="titleValid"
                   placeholder="Title" v-model="titleArticle">
        </div>
        <div class="form-group">
            <label for="article-body">正文</label>
            <textarea class="form-control" id="article-body" rows="10" :class="bodyValid"
                      placeholder="Body" v-model="bodyArticle"></textarea>
        </div>
        <hr class="my-4">
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5"
                         @click="articleSubmit()">确认发表
                </button>
            </div>
        </div>
    </div>

</template>
<script>
    Vue.component('vue-article-data', {
        template: '#template-article-data',
        data: function () {
            return {
                urlTarget: '',
                urlSubmit: '',
                titleArticle: '',
                titleValidMsg: '',
                titleValidTag: false,
                bodyArticle: '',
                bodyValidMsg: '',
                bodyValidTag: false,
            }
        },
        created: function () {
            this.init();
        },
        methods: {
            init: function () {
                let localUrl = window.location.href;
                this.urlTarget = gGetParameterFromUrl(localUrl, 'target');
                if (this.urlTarget === 'create') {
                    this.urlSubmit = 'api/articles/article';
                }
            },
            articleSubmit: function () {
                let thisVue = this;
                axios.post(
                    thisVue.urlSubmit, {
                        'title': thisVue.titleArticle,
                        'body': thisVue.bodyArticle
                    }
                ).then(function (response) {
                    console.debug(response.data);
                }).catch(function (error) {
                    console.error(error.response.data);
                    console.error(error.response.status);
                    console.error(error.response.headers);
                });
            }
        },
        computed: {
            titleValid: function () {
                if (this.titleArticle === null || this.titleArticle === '') {
                    this.titleValidTag = false;
                }
                return '';
            },
            bodyValid: function () {
                if (this.bodyArticle === null || this.bodyArticle === '') {
                    this.bodyValidTag = false;
                }
                return '';
            }
        }
    });
    new Vue({el: "#article-data"});
</script>