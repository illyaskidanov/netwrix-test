<template>
  <div class="partner-search-form">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="8">
          <b-container fluid>
            <b-row>
              <b-col>
                <h1 class="partner-search-form__heading">Netwrix Partner Locator</h1>
                <p class="partner-search-form__description">Hundreds of Netwrix partners around the world are standing by to help you.<br>With our Partner Locator you can easily find the list of authorized partners in your area.</p>
              </b-col>
            </b-row>
            <b-row>
              <b-col>
                <b-input class="partner-search-form__search-input" v-model="searchForm.searchQuery" placeholder="Search by company name or adress..."></b-input>
              </b-col>
            </b-row>
            <b-row>
              <b-col md="4">
                <b-select class="partner-search-form__select" v-model="searchForm.status" :options="statusOptions"></b-select>
              </b-col>
              <b-col md="4">
                <b-select class="partner-search-form__select" v-model="searchForm.country" :options="countryOptions"></b-select>
              </b-col>
              <b-col md="4">
                <b-select class="partner-search-form__select" v-model="searchForm.state" :options="stateOptions" :disabled="!isSelectedCountryHasStates()"></b-select>
              </b-col>
            </b-row>
          </b-container>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import api from '../api'
export default {
  name: "PartnerSearchForm",
  data() {
    return {
      searchForm: {
        searchQuery: '',
        status: '',
        country: '',
        state: '',
      },
      statusOptions: [
        {value: "", text: "Type", disabled: true},
        {value: 'Preferred Partner', text: 'Preferred Partner'},
        {value: 'MSP Partner', text: 'MSP Partner'},
        {value: 'Premium Partner', text: 'Premium Partner'},
        {value: 'Distributor', text: 'Distributor'},
        {value: 'Elite Partner', text: 'Elite Partner'},
      ],
      countries: []
    }
  },
  async mounted() {
    this.countries = await api.get(`/countries`).then(res => res.data);
  },
  watch: {
    searchForm: {
      handler(value) {
        this.$emit('search-form-changed', value)
      },
      deep: true
    }
  },
  methods: {
    isSelectedCountryHasStates() {
      return this.selectedCountry && this.selectedCountry.states.length !== 0;
    }
  },
  computed: {
    countryOptions() {
      return [{value: "", text: "Country", disabled: true}].concat(this.countries.map(c => ({value: c.short_name, text: c.name})));

    },
    stateOptions() {
      let states = [{value: "", text: "State", disabled: true}];
      if (this.isSelectedCountryHasStates()) {
        states = states.concat(this.selectedCountry.states.map(s => ({value: s.short_name, text: s.name})));
      }
      return states;
    },
    selectedCountry() {
      return this.countries.find(c => c.short_name === this.searchForm.country);
    }
  }
}
</script>

<style scoped>
  .partner-search-form {
    height: 500px;
    width: 100%;
    display: flex;
    align-items: center;

    text-align: center;
    background: url("../img/bg_large.png");
  }

  .partner-search-form__search-input {
    border: none;
    padding: 6px 16px;
    margin-bottom: 20px;
  }

  .partner-search-form__search-input::placeholder {
    color: #7F8893;
  }

  .partner-search-form__heading {
    margin-bottom: 20px;

    font-style: normal;
    font-weight: 700;
    font-size: 46px;
    line-height: 28px;
    color: #FFFFFF;
  }

  .partner-search-form__description {
    margin-bottom: 48px;

    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 32px;
    color: #FFFFFF;
  }

  .partner-search-form__select {
    line-height: 1.5;
    padding: 6px 16px;

    outline: none;
    width: 100%;
    background: transparent;
    color: #FFFFFF;
    border-radius: 3px;
    border: 2px solid #FFFFFF;
  }
</style>