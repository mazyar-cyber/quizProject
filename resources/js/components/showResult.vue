<template>
    <div>
        <div class="box-header">
            <h3 class="box-title">نتیجه ی کلی</h3>
        </div>


        <div class="form-group">
            <label>مرتب سازی بر اساس کاربران</label>
            <select class="form-control select2" name="test" style="width: 100%;" required v-model="selecetedUser">
                <option disabled selected>انتخاب کنید</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
            </select>
            <label>مرتب سازی بر اساس آزمون ها</label>
            <select class="form-control select2" name="test" style="width: 100%;" required v-model="selecetedTest">
                <option disabled selected>انتخاب کنید</option>
                <option v-for="test in tests" :key="test.id" :value="test.id">{{test.name}}</option>
            </select>
            <!--            <button class="btn btn-info" @click="searchResult('user',selecetedUser)">جستجو</button>-->
            <button class="btn btn-success" @click="searchResultt()">جستجو</button>
            <button class="btn btn-info" @click="getData()">reset</button>
        </div>


        <br>
        <!--        data table-->
        <div class="box-body table-responsive no-padding" v-if="result.length!=0">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>صورت سوال</th>
                    <th>کاربر</th>
                    <th>جواب کاربر</th>
                    <th>وضعیت</th>
                    <th>زمان پاسخگویی به سوال</th>
                    <th>مدت زمان تاخیر</th>
                    <th style="background: #717870">نمره گرفته شده</th>
                    <th>کل نمره سوال</th>
                    <th>آزمون</th>
                    <th>تاریخ</th>
                </tr>

                <tr v-for="(r,index) in result" :key="index">
                    <td><a v-html="r.question.question" :href="'/admin/question/'+r.question.id+'/edit'"></a>
                    </td>
                    <td><a :href="'/admin/user/'+r.user.id+'/edit'">{{r.user.name}}</a></td>
                    <td> گزینه{{r.userAnswer}}</td>
                    <td>
                        <span class="label label-success" v-if="r.answerStatus=='true'"> صحیح</span>
                        <span class="label label-warning" v-else-if="r.answerStatus=='noAnswer'"> جواب نداده</span>
                        <span class="label label-danger" v-else> غلط</span>
                    </td>
                    <td>{{r.question.TimeToAnswer}}</td>
                    <td>
                        <span v-show="r.relative_delay_timeAnswering">{{(r.relative_delay_timeAnswering)*(r.question.TimeToAnswer)}}</span>
                        <span v-show="!r.relative_delay_timeAnswering">0</span>
                    </td>
                    <td><span style="color: blue">{{r.star}}</span></td>
                    <td>{{r.question.QuestionStar}}</td>
                    <td><a :href="'/admin/test/'+r.test.id+'/edit'">{{r.test.name}}</a></td>
                    <td>{{r.created_at}}</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="alert alert-warning" v-show="result.length==0">اطلاعاتی جهت نمایش وجود ندارد</div>
        <!--        data table-->
    </div>
</template>

<script>
    import HttpService from "../services/HttpServices/HttpService";
    import Notification from "../services/Notication/notify";

    export default {
        name: "showResult",
        data() {
            return {
                result: [],
                sort: 'question',
                users: [],
                tests: [],
                selecetedUser: '',
                selecetedTest: '',
            }
        },
        methods: {
            getData() {
                HttpService.get('/api/getResults/' + this.sort)
                    .then(response => {
                        console.log(response.data);
                        this.result = response.data[0];
                        this.users = response.data[1];
                        this.tests = response.data[2];
                    })
                    .catch(error => console.log(error));
            },
            searchResult(type, searchWord) {
                HttpService.get('/api/searchResults/' + type + '/' + searchWord)
                    .then(response => {
                        console.log(response.data);
                        this.result = response.data[0];
                        this.users = response.data[1];
                        this.tests = response.data[2];
                    })
                    .catch(error => console.log(error));
            },
            searchResultt() {
                let types = [this.selecetedTest, this.selecetedUser];
                console.log(types);
                HttpService.get('/api/searchResults2/' + types)
                    .then(response => {
                        console.log(response.data);
                        this.result = response.data[0];
                        if (this.result.length == 0) {
                            Notification.error('اطلاعاتی جهت نمایش وجود ندارد');
                        }
                        this.users = response.data[1];
                        this.tests = response.data[2];
                    })
                    .catch(error => console.log(error));
            }
        },
        created() {
            this.getData();
        },
    }
</script>

<style scoped>

</style>
