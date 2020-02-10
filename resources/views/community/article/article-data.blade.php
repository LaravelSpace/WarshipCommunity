<template id="template-article-data">
    <div>
        <div class="form-group">
            <label for="article-title">标题</label>
            <input id="article-title" type="text" class="form-control" placeholder="Title" v-model="articleTitle">
        </div>
        <div class="form-group">
            <label for="article-body">正文</label>
            <textarea id="article-body" class="form-control" rows="10" placeholder="Body"></textarea>
        </div>
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-if="submitValid" @click="submitArticle()">@{{ submitTitle }}
                </button>
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-else disabled>@{{ submitTitle }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component("article-data", {
        template: "#template-article-data",
        data: function () {
            return {
                articleId: 0,
                classification: "",
                submitUri: "",
                submitTitle: "",
                articleTitle: "",
                titleIsValid: false,
                titleValidMsg: "",
                articleBody: "",
                bodyIsValid: false,
                bodyValidMsg: "",
                simplemde: null
            }
        },
        created: function () {
            let uriArr = gGetUrIArr(window.location.href);
            this.classification = uriArr[uriArr.length - 1];
            if (this.classification === CLASSIFICATION_WSC.create) {
                this.submitUri = URI_API.article + URI_CONFIG.create;
                this.submitTitle = "确认发表";
            } else if (this.classification === CLASSIFICATION_WSC.edit) {
                this.articleId = uriArr[uriArr.length - 2];
                this.submitUri = URI_API.article + '/' + this.articleId + URI_CONFIG.update;
                this.submitTitle = "确认修改";
                this.itemArticle();
            }
        },
        mounted: function () {
            let thisVue = this;
            // simplemde-markdown-editor 的初始化要放在这里
            this.simplemde = new SimpleMDE({element: document.getElementById("article-body")});
            // 绑定事件，监听输入变化，并把值同步给 Vue 的变量
            this.simplemde.codemirror.on("change", function () {
                thisVue.articleBody = thisVue.simplemde.value();
            });
        },
        methods: {
            itemArticle: function () {
                let thisVue = this;
                let uri = URI_API.article + '/' + thisVue.articleId + URI_CONFIG.edit;
                axios.get(uri).then(function (response) {
                    let articleItem = response.data.data;
                    if (!gIsEmpty(articleItem)) {
                        thisVue.articleTitle = articleItem.title;
                        thisVue.articleBody = articleItem.body;
                        thisVue.simplemde.value(articleItem.body);
                    }
                });
            },
            submitArticle: function () {
                let thisVue = this;
                if (thisVue.classification === CLASSIFICATION_WSC.create) {
                    axios.post(thisVue.submitUri, {
                        "title": thisVue.articleTitle,
                        "body": thisVue.articleBody
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        if (!gIsEmpty(articleId)) {
                            window.location.href = URI_WEB.article + '/' + articleId;
                        }
                    });
                } else if (thisVue.classification === CLASSIFICATION_WSC.edit) {
                    axios.put(thisVue.submitUri, {
                        "id": thisVue.articleId,
                        "title": thisVue.articleTitle,
                        "body": thisVue.articleBody
                    }).then(function (response) {
                        let articleId = response.data.data.article_id;
                        if (!gIsEmpty(articleId)) {
                            window.location.href = URI_WEB.article + '/' + articleId;
                        }
                    });
                }
            }
        },
        computed: {
            submitValid: function () {
                return this.titleIsValid && this.bodyIsValid;
            }
        },
        watch: {
            articleTitle(val) {
                this.titleIsValid = !gIsEmpty(val);
            },
            articleBody(val) {
                this.bodyIsValid = !gIsEmpty(val);
            }
        }
    });
    new Vue({el: "#article-data"});
</script>
