<template>
  <form>
    <div class="row">
      <div  class="col-sm-3">
        <label>{{trans('label_currency')}}</label>
        <PSHelp 
          content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." 
          placement="right"
        />
        <PSSelect id="select-currencies" ref="select-currencies" data-toggle="select2" :items="currencies" itemName="name"></PSSelect>
      </div>
      <div  class="col-sm-2">
        <label class="d-block">{{trans('label_switch')}}</label>
        <PSSwitch />
      </div>
    </div>
    <div class="row align-items-end mt-4">
      <div  class="col-sm-4">
        <label>{{trans('label_currency_name')}}</label>
        <PSInput :value="currency.name" />
      </div>
      <div class="col-sm-1">
        <label>{{trans('label_symbol')}}</label>
        <PSInput :value="symbol" />
      </div>
      <div class="col-sm-1 align-content-end">
        <PSSelect id="select-lang" ref="select-lang" :items="localizations" itemName="lang" itemID="lang" />
      </div>
    </div>
    <div class="row mt-4">
      <div  class="col-sm-2">
        <label>{{trans('label_code')}}</label>
        <PSHelp 
          content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." 
          placement="right"
        />
        <PSInput :value="currency.code" />
      </div>
      <div class="col-sm-2">
        <label>{{trans('label_code_numeric')}}</label>
        <PSHelp 
          content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." 
          placement="right"
        />
        <PSInput :value="currency.numericCode" />
      </div>
      <div class="col-sm-1">
        <label>{{trans('label_decimals')}}</label>
        <PSHelp 
          content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." 
          placement="right"
        />
        <PSSelect ref="decimals" :items="decimals" itemName="name" itemID="value"  />
      </div>
      <div class="col-sm-1">
        <label>{{trans('label_exchange')}}<sup>*</sup></label>
        <PSInput :value="currency.exchangeRate" />
      </div>
    </div>
  </form>
</template>

<script>
  import PSSelect from 'app/widgets/ps-select';
  import PSSwitch from 'app/widgets/ps-switch';
  import PSInput from 'app/widgets/ps-input';
  import PSHelp from 'app/widgets/ps-help';

  export default {
    components: {
      PSSelect,
      PSSwitch,
      PSInput,
      PSHelp,
    },
    computed: {
      decimals() {
        const decimals = [];
        for (let i = 0; i <= 10; i += 1) {
          decimals.push({
            name: i,
            value: i,
          });
        }
        return decimals;
      },
      currency() {
        return this.$store.state.currency;
      },
      currencies() {
        return this.$store.state.currencies;
      },
      currentLocalization() {
        return this.$store.getters.currentLocalization;
      },
      localizations() {
        return this.$store.getters.localizations;
      },
    },
    watch: {
      currencies() {
        $('#select-currencies select').select2({
          data: this.currencies,
        });
        $('b[role="presentation"]').hide();
      },
      currency() {
        this.$refs.decimals.selected = this.currency.decimals;
        this.$refs['select-currencies'].selected = this.currency.name;
      },
      currentLocalization(current) {
        this.symbol = current.symbol;
        this.lang = current.lang;
        this.$refs['select-lang'].selected = this.lang;
      },
    },
    data: () => ({
      symbol: '',
    }),
  };
</script>

<style lang="sass" scoped>
  @import "../../../../../../scss/config/_settings.scss";
  sup {
    color: $brand-danger;
  }
</style>
