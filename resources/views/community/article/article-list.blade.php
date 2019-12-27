<template id="template-article-list">
    <div>
        <ul class="list-unstyled" v-if="vifArticleShow">
            <li class="media" v-for="article in articleList"
                style="border:2px solid #007bff;border-radius: 25px 50px;margin: 10px 0; padding: 10px 30px">
                <img class="rounded-circle mr-3" style="width: 50px; height: 50px"
                     src="" :src="article.user.avatar" alt="" :alt="article.user_id">
                <div class="media-body">
                    <a href="#" :href="['/article/'+article.id]">
                        <h5 class="mt-0 mb-1">@{{ article.title }}</h5>
                    </a>
                    <p>@{{ article.main_body }}</p>
                </div>
            </li>
        </ul>
        <nav aria-label="article paginate navigation" v-if="vifPaginateShow">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item" :class="prevPage">
                    <button class="page-link" aria-label="Previous" @click="getArticleList(paginate.prev_page)">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </button>
                </li>
                <li class="page-item" :class="activePage(page)" v-for="page in paginate.page_list">
                    <button class="page-link" @click="getArticleList(page)">@{{ page }}</button>
                </li>
                <li class="page-item" :class="nextPage">
                    <button class="page-link" aria-label="Next" @click="getArticleList(paginate.next_page)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    Vue.component("article-list", {
        template: "#template-article-list",
        data: function () {
            return {
                articleList: [], vifArticleShow: false,
                paginate: [], vifPaginateShow: false
            }
        },
        created: function () {
            this.getArticleList();
        },
        methods: {
            getArticleList: function (page) {
                let thisVue = this;
                let uri = URI_API.article;
                if (page !== null && page !== "" && page > 0) {
                    uri += '?page=' + page;
                }
                axios.get(uri).then(function (response) {
                    thisVue.articleList = response.data.data.article_list;
                    if (thisVue.articleList.length > 0) {
                        thisVue.vifArticleShow = true;
                    }
                    thisVue.paginate = response.data.data.paginate;
                    if (thisVue.paginate.page_list.length > 0) {
                        thisVue.vifPaginateShow = true;
                    }
                });
            }
        },
        computed: {
            prevPage: function () {
                if (this.paginate.prev_page === null || this.paginate.prev_page === "") {
                    return "disabled";
                }
                return "";
            },
            nextPage: function () {
                if (this.paginate.next_page === null || this.paginate.next_page === "") {
                    return "disabled";
                }
                return "";
            },
            activePage() {
                return function (page) {
                    if (this.paginate.current_page === page) {
                        return "active";
                    }
                    return "";
                }
            }
        }
    });
    new Vue({el: "#article-list"});
</script>

<template id="template-vue-paginate">
    <nav aria-label="article paginate navigation">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item" :class="prevPage">
                <a class="page-link" href="#" :href="prevPageUrl" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item" v-for="page in paginate.page_list">
                <a class="page-link" href="#" :href="pageUrl(page)">@{{ page }}</a>
            </li>
            <li class="page-item" :class="nextPage">
                <a class="page-link" href="#" :href="nextPageUrl" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
    Vue.component("vue-paginate", {
        template: "#template-vue-paginate",
        props: ['parent_paginate'],
        data: function () {
            return {
                paginate: this.parent_paginate, vifPaginateShow: false
            }
        },
        methods: {
            pageUrl: function (page) {
                return URI_WEB.article + '?page=' + page;
            }
        },
        computed: {
            prevPage: function () {
                if (this.paginate.prev_page === null || this.paginate.prev_page === "") {
                    return "disabled";
                }
                return "";
            },
            prevPageUrl: function () {
                if (this.paginate.prev_page === null || this.paginate.prev_page === "") {
                    return URI_WEB.article + '?page=' + this.paginate.prev_page;
                }
                return "";
            },
            nextPage: function () {
                if (this.paginate.next_page === null || this.paginate.next_page === "") {
                    return "disabled";
                }
                return "";
            },
            nextPageUrl: function () {
                if (this.paginate.next_page === null || this.paginate.next_page === "") {
                    return URI_WEB.article + '?page=' + this.paginate.next_page;
                }
                return "";
            }
        }
    });
    new Vue({el: "#vue-paginate"});
</script>
