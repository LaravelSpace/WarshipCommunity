<template id="template-article-data">
    <div>
        <div class="form-group">
            <label for="article-title">标题</label>
            {{--<input id="article-title" type="text" class="form-control" placeholder="Title"--}}
            {{--:class="titleValid" v-model="title">--}}
            <input id="article-title" type="text" class="form-control" placeholder="Title" v-model="title">
        </div>
        <div class="form-group">
            <label for="article-body">正文</label>
            {{--<textarea class="form-control" id="article-body" rows="10" placeholder="Body"--}}
            {{--:class="bodyValid" v-model="body"></textarea>--}}
            <textarea id="article-body" class="form-control" rows="10" placeholder="Body"></textarea>
        </div>
        <hr class="my-4">
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-if="submitValid" @click="submit()">@{{ uriTitle }}
                </button>
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-else disabled>@{{ uriTitle }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('article-data', {
        template: '#template-article-data',
        data: function () {
            return {
                articleId: 0,
                classification: '', uriSubmit: '', uriTitle: '',
                title: '', titleValidMsg: '', titleValidTag: false,
                body: '', bodyValidMsg: '', bodyValidTag: false,
                simplemde: null
            }
        },
        created: function () {
            let uriArr = gGetUrI(window.location.href);
            this.classification = uriArr[uriArr.length - 1];
            if (this.classification === 'store') {
                this.uriSubmit = URI_API.article + URI_CONFIG.store;
                this.uriTitle = '确认发表';
            } else if (this.classification === 'edit') {
                this.articleId = uriArr[uriArr.length - 2];
                this.uriSubmit = URI_API.article + '/' + this.articleId + URI_CONFIG.update;
                this.uriTitle = '确认修改';
                this.getArticleItem();
            }
        },
        mounted: function () {
            let thisVue = this;
            // simplemde-markdown-editor 的初始化要放在这里
            this.simplemde = new SimpleMDE({element: document.getElementById('article-body')});
            // 绑定事件，监听输入变化，并把值同步给 Vue 的变量
            this.simplemde.codemirror.on('change', function () {
                thisVue.body = thisVue.simplemde.value();
            });
        },
        methods: {
            getArticleItem: function () {
                let thisVue = this;
                let uri = URI_API.article + '/' + thisVue.articleId + URI_CONFIG.edit;
                axios.get(uri).then(function (response) {
                    let articleItem = response.data.data;
                    if (articleItem !== null && articleItem !== '') {
                        thisVue.title = articleItem.title;
                        thisVue.body = articleItem.body;
                        thisVue.simplemde.value(articleItem.body);
                        thisVue.vifShow = true;
                    }
                }).catch(function (error) {
                    console.error(error.response);
                });
            },
            submit: function () {
                let thisVue = this;
                if (thisVue.classification === 'store') {
                    axios.post(thisVue.uriSubmit, {
                        'title': thisVue.title,
                        'body': thisVue.body
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        if (articleId !== null && articleId !== '') {
                            window.location.href = URI_WEB.article + '/' + articleId;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                } else if (thisVue.classification === 'edit') {
                    axios.put(thisVue.uriSubmit, {
                        'id': thisVue.articleId,
                        'title': thisVue.title,
                        'body': thisVue.body
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        if (articleId !== null && articleId !== '') {
                            window.location.href = URI_WEB.article + '/' + articleId;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                }
            }
        },
        computed: {
            submitValid: function () {
                return this.titleValidTag && this.bodyValidTag;
            }
        },
        watch: {
            title(val) {
                if (val !== null && val !== '') {
                    this.titleValidTag = true;
                } else {
                    this.titleValidTag = false;
                }
            },
            body(val) {
                if (val !== null && val !== '') {
                    this.bodyValidTag = true;
                } else {
                    this.bodyValidTag = false;
                }
            }
        }
    });
    new Vue({el: '#article-data'});
</script>