<template id="template-article-data">
    <div>
        <div class="form-group">
            <label for="article-title">标题</label>
            <input id="article-title" type="text" class="form-control" :class="titleValid"
                   placeholder="Title" v-model="titleArticle">
        </div>
        <div class="form-group">
            <label for="article-body">正文</label>
            {{--<textarea class="form-control" id="article-body" rows="10" :class="bodyValid"--}}
            {{--placeholder="Body" v-model="bodyArticle"></textarea>--}}
            <textarea id="article-body" class="form-control" rows="10" placeholder="Body"></textarea>
        </div>
        <hr class="my-4">
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5" @click="articleSubmit()">
                    @{{ submitTitle }}
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
                articleId: 0,
                urlTarget: '', submitUrl: '', submitTitle: '',
                titleArticle: '', titleValidMsg: '', titleValidTag: false,
                bodyArticle: '', bodyValidMsg: '', bodyValidTag: false,
                simplemde: null
            }
        },
        created: function () {
            let localUrl = window.location.href;
            let localUrlArray = gSplitUrl(localUrl);
            this.urlTarget = localUrlArray[localUrlArray.length - 1];
            if (this.urlTarget === 'create') {
                this.submitUrl = COMMUNITY_API_URL.article+COMMUNITY_URL.store;
                this.submitTitle = '确认发表';
            } else if (this.urlTarget === 'edit') {
                this.articleId = localUrlArray[localUrlArray.length - 2];
                this.submitUrl = COMMUNITY_API_URL.article + '/' + this.articleId+ COMMUNITY_URL.update;
                this.submitTitle = '确认修改';
                this.getArticleItem();
            }
        },
        mounted: function () {
            let thisVue = this;
            // simplemde-markdown-editor 的初始化要放在这里
            this.simplemde = new SimpleMDE({element: document.getElementById('article-body')});
            // 绑定事件，监听输入变化，并把值同步给 Vue 的变量
            this.simplemde.codemirror.on('change', function () {
                thisVue.bodyArticle = thisVue.simplemde.value();
            });
        },
        methods: {
            getArticleItem: function () {
                let thisVue = this;
                let url = COMMUNITY_API_URL.article + '/' + thisVue.articleId + COMMUNITY_URL.edit;
                axios.get(url).then(function (response) {
                    let articleItem = response.data.data;
                    thisVue.titleArticle = articleItem.title;
                    thisVue.simplemde.value(articleItem.body);
                    thisVue.bodyArticle = articleItem.body;
                    if (articleItem !== null) {
                        thisVue.vifShow = true;
                    }
                }).catch(function (error) {
                    console.error(error.response);
                });
            },
            articleSubmit: function () {
                let thisVue = this;
                if (thisVue.urlTarget === 'create') {
                    axios.post(thisVue.submitUrl, {
                        'title': thisVue.titleArticle,
                        'body': thisVue.bodyArticle
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        window.location.href = COMMUNITY_WEB_URL.article + '/' + articleId;
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                } else if (thisVue.urlTarget === 'edit') {
                    axios.put(thisVue.submitUrl, {
                        'id': thisVue.articleId,
                        'title': thisVue.titleArticle,
                        'body': thisVue.bodyArticle
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        window.location.href = COMMUNITY_WEB_URL.article + '/' + articleId;
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                }
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
    new Vue({el: '#article-data'});
</script>