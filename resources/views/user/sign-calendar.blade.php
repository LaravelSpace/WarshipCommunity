<template id="template-sign-calendar">
    <div>
        <table class="table table-borderless text-center">
            <thead>
            <tr>
                <th colspan="5">签到日历</th>
                <th colspan="2">
                    <button class="btn btn-sm btn-secondary" v-if="isSigned" disabled>已签到</button>
                    <button class="btn btn-sm btn-primary" v-else="isSigned" @click="markSignCanendar()">签到</button>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="oneLine in signCalendarList">
                <td v-for="(value,keyDate) in oneLine" :class="calendarClass(value)">
                    @{{ keyDate }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    Vue.component("sign-calendar", {
        template: "#template-sign-calendar",
        data: function () {
            return {
                isSigned: true,
                signCalendarList: []
            }
        },
        created: function () {
            let thisVue = this;
            let uri = URI_API.user.sign_calendar;
            axios.get(uri).then(function (response) {
                let signCalendarList = response.data.data;
                let oneLine = {};
                let i = 1;
                Object.keys(signCalendarList).forEach(function (key) {
                    if (signCalendarList[key] === 2) {
                        thisVue.isSigned = false;
                    }
                    oneLine[key] = signCalendarList[key];
                    if (i % 7 === 0) {
                        thisVue.signCalendarList.push(oneLine);
                        oneLine = {};
                    }
                    i++;
                });
                thisVue.signCalendarList.push(oneLine);
            });
        },
        methods: {
            markSignCanendar: function () {
                let thisVue = this;
                let uri = URI_API.user.sign_calendar;
                axios.post(uri).then(function (response) {
                    let signCalendarList = response.data.data;
                    let oneLine = {};
                    let i = 1;
                    thisVue.signCalendarList = [];
                    Object.keys(signCalendarList).forEach(function (key) {
                        if (signCalendarList[key] === 2) {
                            this.isSigned = false;
                        }
                        oneLine[key] = signCalendarList[key];
                        if (i % 7 === 0) {
                            thisVue.signCalendarList.push(oneLine);
                            oneLine = {};
                        }
                        i++;
                    });
                    thisVue.signCalendarList.push(oneLine);
                });
            },
            calendarClass: function (tag) {
                if (tag === 0) {
                    return "table-secondary";
                }
                if (tag === 2) {
                    return "table-primary";
                }
                return "table-success";
            }
        }
    });
    new Vue({el: "#sign-calendar"});
</script>