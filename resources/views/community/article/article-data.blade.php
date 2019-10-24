<template id="template-article-data">
    <div>
        <div class="form-group">
            <label for="article-title">标题</label>
            <input type="text" class="form-control" id="article-title" :class="titleValid"
                   placeholder="Title" v-model="titleArticle">
        </div>
        <div class="form-group">
            <label for="article-body">正文</label>
            {{--<textarea class="form-control" id="article-body" rows="10" :class="bodyValid"--}}
            {{--placeholder="Body" v-model="bodyArticle"></textarea>--}}
            <textarea class="form-control" id="article-body" rows="10" placeholder="Body"></textarea>
        </div>
        <hr class="my-4">
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5"
                        @click="articleSubmit()">@{{ submitTitle }}</button>
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
                articleItem: '',
                urlArray: [],
                urlTarget: '',
                submitUrl: '',
                submitTitle: '',
                titleArticle: '',
                titleValidMsg: '',
                titleValidTag: false,
                bodyArticle: '',
                bodyValidMsg: '',
                bodyValidTag: false,
                simplemde: null
            }
        },
        created: function () {
            this.init();
        },
        mounted: function () {
            let thisVue = this;
            if (this.urlTarget === 'edit') {
                document.getElementById('article-title').disabled = true; // 标题不允许修改
            }
            // simplemde-markdown-editor 的初始化要放在这里
            this.simplemde = new SimpleMDE({element: document.getElementById('article-body')});
            // 绑定事件，监听输入变化，并把值同步给 Vue 的变量
            this.simplemde.codemirror.on('change', function () {
                thisVue.bodyArticle = thisVue.simplemde.value();
            });
        },
        methods: {
            init: function () {
                let localUrl = window.location.href;
                this.urlArray = gSplitUrl(localUrl);
                this.urlTarget = this.urlArray[this.urlArray.length - 1];
                if (this.urlTarget === 'create') {
                    this.submitUrl = COMMUNITY_URL.article_store;
                    this.submitTitle = '确认发表';
                } else if (this.urlTarget === 'edit') {
                    this.articleId = this.urlArray[this.urlArray.length - 2];
                    this.submitUrl = COMMUNITY_URL.articles + '/' + this.articleId;
                    this.submitTitle = '确认修改';
                    this.getArticleItem();
                }
            },
            getArticleItem: function () {
                let thisVue = this;
                let localUrl = window.location.href;
                let localUrlArray = gSplitUrl(localUrl);
                thisVue.articleId = localUrlArray[localUrlArray.length - 2];
                let url = COMMUNITY_URL.articles + '/' + thisVue.articleId
                    + '?' + COMMUNITY_URL.need_data + '&' + COMMUNITY_URL.markdown;
                axios.get(url).then(function (response) {
                    thisVue.articleItem = response.data.data;
                    thisVue.titleArticle = thisVue.articleItem.title;
                    thisVue.simplemde.value(thisVue.articleItem.main_body);
                    thisVue.bodyArticle = thisVue.articleItem.main_body;
                    if (thisVue.articleItem !== null) {
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
                        thisVue.articleItem = response.data.data;
                        // window.location.href = COMMUNITY_URL.articles + '/' + thisVue.articleItem.id;
                        window.location.href = COMMUNITY_URL.articles;
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                } else if (thisVue.urlTarget === 'edit') {
                    axios.put(thisVue.submitUrl, {
                        'id': thisVue.articleId,
                        'title': thisVue.titleArticle,
                        'body': thisVue.bodyArticle
                    }).then(function (response) {
                        thisVue.articleId = response.data.data.id;
                        // window.location.href = COMMUNITY_URL.articles + '/' + thisVue.articleId;
                        window.location.href = COMMUNITY_URL.articles;
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