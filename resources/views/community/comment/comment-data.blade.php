<template id="template-comment-data">
    <div>
        <hr class="my-4">
        <div class="form-group">
            <textarea id="comment-body" class="form-control" rows="5" placeholder="Body"></textarea>
        </div>
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
    Vue.component('comment-data', {
        template: '#template-comment-data',
        props: ['article_id'],
        data: function () {
            return {
                articleId: this.article_id, commentId: 0,
                classification: '', uriSubmit: '', uriTitle: '',
                body: '', bodyValidMsg: '', bodyValidTag: false,
                simplemde: null
            }
        },
        created: function () {
            this.uriSubmit = URI_API.comment + URI_CONFIG.store;
            this.uriTitle = '确认发表';
        },
        mounted: function () {
            let thisVue = this;
            this.simplemde = new SimpleMDE({element: document.getElementById('comment-body')});
            this.simplemde.codemirror.on('change', function () {
                thisVue.body = thisVue.simplemde.value();
            });
        },
        methods: {
            submit: function () {
                let thisVue = this;
                    axios.post(thisVue.uriSubmit, {
                        'article_id': thisVue.articleId,
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
        },
        computed: {
            submitValid: function () {
                return this.bodyValidTag;
            }
        },
        watch: {
            body(val) {
                if (val !== null && val !== '') {
                    this.bodyValidTag = true;
                } else {
                    this.bodyValidTag = false;
                }
            }
        }
    });
    new Vue({el: '#comment-data'});
</script>