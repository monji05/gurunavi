<template>
    <div class="container">
        <div>
            <div class="search-form text-center">
                <form action="/api/gurunavi" method="POST" v-on:submit.prevent="getStore">
                    <div class="text-input">
                        <label for="freeWord">{{ label }}</label>
                    </div>
                    <div class="text-input">
                        <input type="text" name="freeWord" id="freeWord" v-model="freeWord" placeholder="焼肉 渋谷" class="form-control col-12 m-auto">
                    </div>
                    <div>
                        <label for="card" class="text-label">
                            <input type="checkbox" name="card" id="card" true-value="1" false-value="0" v-model="card">
                            <i class="material-icons">credit_card</i>
                            カードOK
                        </label>
                        <label for="wifi" class="text-label">
                            <input type="checkbox" name="wifi" id="wifi" true-value="1" false-value="0" v-model="wifi">
                            <i class="material-icons">network_wifi</i>
                            wifiあり
                        </label>
                    </div>
                    <div>
                        <label for="budgetCode">
                            予算
                            <select name="budgetCode" id="budgetCode" v-model="budgetCode">
                                <option value="">選択しない</option>
                                <option value="B009">〜500円</option>
                                <option value="B010">501～1000円</option>
                                <option value="B011">1001～1500円</option>
                                <option value="B001">1501～2000円</option>
                                <option value="B002">2001～3000円</option>
                                <option value="B003">3001～4000円</option>
                                <option value="B008">4001～5000円</option>
                                <option value="B004">5001～7000円</option>
                                <option value="B005">7001～10000円</option>
                                <option value="B006">10001～15000円</option>
                                <option value="B012">15001～20000円</option>
                                <option value="B013">20001～30000円</option>
                                <option value="B014">30001円～</option>
                            </select>
                        </label>
                    </div>
                    <button type="submit">検索</button>
                </form>
            </div>
        </div>
        <div v-show="loading" class="loader-bg">
            <div class="loader">
            </div>
        </div>
        <div v-show="!loading" v-if="count!=0">
            <div class="alert alert-primary text-center mr-3 mt-3">{{ total }}件ヒットしました</div>
            <paginate-links
                for="paginate-storeLists"
                class="pagination justify-content-center"
                :limit="20"
                :show-step-links="true"
                :step-links="{
                    next: '>',
                    prev: '<',
                }"
                :classes="{
                    'ul.paginate-links > li': 'page-item',
                    'ul.paginate-links > li > a': 'page-link',
                }"
            >
            </paginate-links>
            <div>
                <paginate name="paginate-storeLists" tag="div" :list="storeLists" :per="20">
                    <div v-for="storeList in paginated('paginate-storeLists')" class="store">
                        <div class="mx-3 mt-3">
                            <p><img :src="storeList.photo"></p>
                        </div>
                        <div class="mx-3">
                            <p class="h3"><a :href="storeList.url">{{ storeList.name }}</a></p>
                            <div class="row no-gutters">
                                <p>{{ storeList.access }}</p>
                            </div>
                            <div class="row no-gutters">
                                <p>{{ storeList.address }}</p>
                            </div>
                            <div class="row no-gutters">
                                <p class="font-weight-bolder list-inline-item">営業時間:</p>
                                <p>{{ storeList.open }}</p>
                            </div>
                            <div class="row no-gutters">
                                <p class="font-weight-bolder list-inline-item">クレジットカード:</p>
                                <div v-if="storeList.type">
                                    <div v-for="type in storeList.type" class="list-inline-item">
                                        <p v-if="type['name']=='VISA'"><img src="/image/logo_visa.gif" alt="logo_visa">&nbsp;</p>
                                        <p v-if="type['name']=='マスター'"><img src="/image/logo_mastercard.gif" alt="logo_master">&nbsp;</p>
                                        <p v-if="type['name']=='アメックス'"><img src="/image/logo_americanexpress.jpeg" alt="logo_americanexpress">&nbsp;</p>
                                        <p v-if="type['name']=='JCB'"><img src="/image/logo_jcb.gif" alt="logo_jcb">&nbsp;</p>
                                        <p v-if="type['name']=='銀聯'"><img src="/image/logo_ginren.gif" alt="logo_ginren">&nbsp;</p>
                                        <p v-if="type['name']=='Discover'"><img src="/image/logo_discover.gif" alt="logo_discover">&nbsp;</p>
                                        <p v-if="type['name']=='DINERS'"><img src="/image/logo_diners.gif" alt="logo_diners">&nbsp;</p>
                                    </div>
                                </div>
                                <div v-else>
                                    <p>×</p>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <p class="font-weight-bolder list-inline-item">料金備考:</p>
                                <p v-if="storeList.budget_memo">{{ storeList.budget_memo }}</p>
                                <p v-else>なし</p>
                            </div>
                        </div>
                    </div>
                </paginate>
            </div>
            <paginate-links
                for="paginate-storeLists"
                class="pagination justify-content-center"
                :limit="20"
                :show-step-links="true"
                :step-links="{
                    next: '>',
                    prev: '<',
                }"
                :classes="{
                    'ul.paginate-links > li': 'page-item',
                    'ul.paginate-links > li > a': 'page-link',
                }"
            >
            </paginate-links>
        </div>
        <div v-show="returned" class="alert alert-primary text-center ml-3 mr-3 mt-3">
            結果なし
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            label: "お店を検索",
            storeLists: [],
            totalPage: [],
            paginate: ['paginate-storeLists'],
            card: "0",
            wifi: "0",
            freeWord: "",
            count: "",
            total: "",
            loading: false,
            returned: false,
            budgetCode: "",
        }
    },
    methods: {
        getStore: function () {
            let $this = this
            const params = new URLSearchParams();
            params.append('freeWord', this.freeWord)
            params.append('card', this.card)
            params.append('wifi', this.wifi)
            params.append('budgetCode', this.budgetCode)
            $this.loading = true
            axios.post('http://localhost/api/gurunavi', params)
            .then(res => {
                $this.loading = false
                let result = res.data.results
                let shops = result.shop
                //返ってきた結果の件数
                $this.count = result.results_returned
                if ($this.count > 0) {
                    $this.returned = false
                } else if ($this.count == 0) {
                    $this.returned = true
                }
                //ヒットした検索の総数
                $this.total = result.results_available
                //検索結果を初期化
                $this.storeLists = []
                for(let shop of shops){
                    $this.storeLists.push({
                        name: shop.name,
                        access: shop.access,
                        address: shop.address,
                        url: shop.urls.pc,
                        open: shop.open,
                        card: shop.card,
                        type: shop.credit_card,
                        photo: shop.photo.pc.l,
                        budget_memo: shop.budget_memo,
                    })
                }
            })
        },
    },

}

</script>