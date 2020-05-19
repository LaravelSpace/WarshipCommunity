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
                if (!gIsEmpty(this.paginate.prev_page)) {
                    return "disabled";
                }
                return "";
            },
            prevPageUrl: function () {
                if (!gIsEmpty(this.paginate.prev_page)) {
                    return URI_WEB.article + '?page=' + this.paginate.prev_page;
                }
                return "";
            },
            nextPage: function () {
                if (!gIsEmpty(this.paginate.next_page)) {
                    return "disabled";
                }
                return "";
            },
            nextPageUrl: function () {
                if (!gIsEmpty(this.paginate.next_page)) {
                    return URI_WEB.article + '?page=' + this.paginate.next_page;
                }
                return "";
            }
        }
    });
    new Vue({el: "#vue-paginate"});
</script>
