<template>
    <div>
        <form @submit.prevent="searchProp" class="search-form">
            <div class="row" style="width: 100%">
                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="Name">Название</label>
                    <input class="input-group-text mx-2 px-4 border-4" type="text" id="Name" v-model="search.Name" list="Name-list">

                    <datalist id="Name-list">
                        <option v-for="option in nameOptions" :value="option">{{ option }}</option>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="Bedrooms">Кол-во спален</label>
                    <input class="input-group-text mx-2 px-2 border-4" type="number" id="Bedrooms" v-model.number="search.Bedrooms" list="Bedrooms-list">

                    <datalist id="Bedrooms-list">
                        <option v-for="option in bedroomsOptions" :value="option">{{ option }}</option>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="Bathrooms">Кол-во ванных комнат</label>
                    <input class="input-group-text mx-2 px-2 border-4" type="number" id="Bathrooms" v-model.number="search.Bathrooms" list="Bathrooms-list">

                    <datalist id="Bathrooms-list">
                        <option v-for="option in bathroomsOptions" :value="option">{{ option }}</option>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="Storeys">Кол-во этажей</label>
                    <input class="input-group-text mx-2 px-2 border-4" type="number" id="Storeys" v-model.number="search.Storeys" list="Storeys-list">

                    <datalist id="Storeys-list">
                        <option v-for="option in storeysOptions" :value="option">{{ option }}</option>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="Garages">Кол-во гаражей</label>
                    <input class="input-group-text mx-2 px-2 border-4" type="number" id="Garages" v-model.number="search.Garages" list="Garages-list">

                    <datalist id="Garages-list">
                        <option v-for="option in garagesOptions" :value="option">{{ option }}</option>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label class="form-label mx-2 h4" for="price_min, price_max">Цена</label>
                    <br>
                    <input class="input-group-text mx-2 border-4 d-inline-block" type="number" id="price_min" v-model.number="search.price_min" placeholder="От">
                    <p class="d-inline-block fs-5"> — </p>
                    <input class="input-group-text mx-2 border-4 d-inline-block" type="number" id="price_max" v-model.number="search.price_max" placeholder="До">
                </div>


            </div>
            <br>
            <div class="col-md-6"></div>
            <button class="btn btn-outline-success mx-2 fs-5 mb-3 fw-bold" style="width: 10%;" type="submit">
                Поиск
                <span class="spinner-border spinner-border-sm" v-if="loading" aria-hidden="true"></span>
            </button>

        </form>


        <table v-if="prop.length" class="table table-hover">
            <thead class="table-dark fw-bold fs-4">
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Кол-во спален</th>
                <th>Кол-во ванных комнат</th>
                <th>Кол-во этажей</th>
                <th>Кол-во гаражей</th>
            </tr>
            </thead>
            <tbody class="table-group-divider table-light">
            <tr v-for="prop in prop" :key="prop.id">
                <td>{{ prop.id }}</td>
                <td>{{ prop.Name }}</td>
                <td>{{ prop.Price }}</td>
                <td>{{ prop.Bedrooms }}</td>
                <td>{{ prop.Bathrooms }}</td>
                <td>{{ prop.Storeys }}</td>
                <td>{{ prop.Garages }}</td>
            </tr>
            </tbody>
        </table>

        <h1 v-else class="mx-2 fs-4 mb-3">
            <span class="text-dark">Запись не найдена (╥_╥)</span>
        </h1>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            prop: [true],
            search: {
                Name: "",
                Bedrooms: null,
                Bathrooms: null,
                Storeys: null,
                Garages: null,
                price_min: null,
                price_max: null,
            },
            loading: false,
            nameOptions: [], // массив данных для выпадающего меню
            bedroomsOptions: [], // массив данных для выпадающего меню
            bathroomsOptions: [], // массив данных для выпадающего меню
            storeysOptions: [],
            garagesOptions: []
        };
    },
    mounted() {
        const options = [
            { name: 'nameOptions', param: 'Name' },
            { name: 'bedroomsOptions', param: 'Bedrooms' },
            { name: 'bathroomsOptions', param: 'Bathrooms' },
            { name: 'storeysOptions', param: 'Storeys' },
            { name: 'garagesOptions', param: 'Garages' },
        ];

        options.forEach(({ name, param }) => {
            axios
                .get(`/api/v1/prop?per_page=10000&${param}=true`)
                .then((response) => {
                    const values = [...new Set(response.data.data.map((prop) => prop[param]))];
                    this[name] = values;
                })
                .catch((error) => {
                    console.error(error);
                });
        });
    },
    methods: {
        searchProp() {
            this.loading = true;
            axios
                .get("/api/v1/prop", {
                    params: {
                        per_page: 10000,
                        Name: this.search.Name,
                        Bedrooms: this.search.Bedrooms,
                        Bathrooms: this.search.Bathrooms,
                        Storeys: this.search.Storeys,
                        Garages: this.search.Garages,
                        price_min: this.search.price_min,
                        price_max: this.search.price_max,
                        ...this.getFilterParams(),
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    this.prop = response.data.data;
                })
                .catch((error) => {
                    console.error(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        getFilterParams() {
            let params = {};
            for (let filter in this.search) {
                if (this.search[filter] !== null && this.search[filter] !== "") {
                    let operator = null;
                    if (filter === "name") {
                        operator = "like";
                        params[`${filter}[${operator}]`] = `%${this.search[filter]}%`;
                    } else {
                        operator = "eq";
                        params[`${filter}[${operator}]`] = this.search[filter];
                    }
                }
            }
            if (this.search.price_min !== null && this.search.price_min !== "") {
                params["price[range]"] = `${this.search.price_min},${this.search.price_max}`;
            } else if (this.search.price_max !== null && this.search.price_max !== "") {
                params["price[range]"] = `,${this.search.price_max}`;
            }

            return params;
        },
    },
};
</script>
