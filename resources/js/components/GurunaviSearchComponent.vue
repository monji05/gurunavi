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
                        <label for="privateRoom" class="text-label">
                            <input type="checkbox" name="privateRoom" id="privateRoom" true-value="1" false-value="0" v-model="privateRoom">
                            <i class="material-icons">person</i>
                            個室あり
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
                    <div>
                        <label for="prefName">
                            都道府県
                            <select name="prefName" id="prefName" v-model="prefName">
                                <option value="Z041">北海道</option>
                                <option value="Z051">青森県</option>
                                <option value="Z052">岩手県</option>
                                <option value="Z053">宮城県</option>
                                <option value="Z054">秋田県</option>
                                <option value="Z055">山形県</option>
                                <option value="Z056">福島県</option>
                                <option value="Z015">茨城県</option>
                                <option value="Z016">栃木県</option>
                                <option value="Z017">群馬県</option>
                                <option value="Z013">埼玉県</option>
                                <option value="Z014">千葉県</option>
                                <option value="Z011">東京都</option>
                                <option value="Z012">神奈川県</option>
                                <option value="Z061">新潟県</option>
                                <option value="Z062">富山県</option>
                                <option value="Z063">石川県</option>
                                <option value="Z064">福井県</option>
                                <option value="Z065">山梨県</option>
                                <option value="Z066">長野県</option>
                                <option value="Z031">岐阜県</option>
                                <option value="Z032">静岡県</option>
                                <option value="Z033">愛知県</option>
                                <option value="Z034">三重県</option>
                                <option value="Z021">滋賀県</option>
                                <option value="Z022">京都府</option>
                                <option value="Z023">大阪府</option>
                                <option value="Z024">兵庫県</option>
                                <option value="Z025">奈良県</option>
                                <option value="Z026">和歌山県</option>
                                <option value="Z071">鳥取県</option>
                                <option value="Z072">島根県</option>
                                <option value="Z073">岡山県</option>
                                <option value="Z074">広島県</option>
                                <option value="Z075">山口県</option>
                                <option value="Z081">徳島県</option>
                                <option value="Z082">香川県</option>
                                <option value="Z083">愛媛県</option>
                                <option value="Z084">高知県</option>
                                <option value="Z091">福岡県</option>
                                <option value="Z092">佐賀県</option>
                                <option value="Z093">長崎県</option>
                                <option value="Z094">熊本県</option>
                                <option value="Z095">大分県</option>
                                <option value="Z096">宮崎県</option>
                                <option value="Z097">鹿児島県</option>
                                <option value="Z098">沖縄県</option>
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
        <div v-show="returned" class="alert text-center ml-3 mr-3 mt-3" v-bind:class="{'alert-primary': countIsZero, 'alert-danger': hasError}">
            {{ message }}
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
            message: "",
            countIsZero: false,
            hasError: false,
            privateRoom: "0",
            prefName: "Z011",
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
            params.append('privateRoom', this.privateRoom)
            params.append('prefName', this.prefName)
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
                    $this.countIsZero = true
                    $this.message = "検索結果なし"
                }
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
            }).catch(function(error) {
                if (error.code == 1000 || error.code == 2000 || error.code == 3000) {
                    $this.returned = true
                    $this.loading = false
                    $this.hasError = true
                    $this.message = error.message
                }
            }) 
        },
    },

}

</script>