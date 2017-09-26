<template>
  <div>
    <h2>{{trans('label_currency_format')}}</h2>
    <div class="row mt-3">
      <div class="col-sm-2">
        <label>
          {{trans('label_format')}}
          <PSHelp 
            content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." 
            lacement="right"
          />
        </label>
        <PSSelect />
        <PSButton class="mt-3" sm :primary="false">{{trans('button_reset')}}</PSButton>
      </div>
      <div class="col-sm-2">
        <label>
          {{trans('label_format_negative')}}
        </label>
        <PSSelect />
      </div>
    </div>
    <h2 class="mt-5">{{trans('label_format_preview')}}</h2>
    <div class="row mt-3">
      <div class="col-sm-4">
        <PSTable>
          <tbody>
            <FormatLine
              v-for="(language, index) in 5"
              key=${index}
            />
          </tbody>
        </PSTable>
      </div>
    </div>
  </div>
</template>

<script>
  import PSHelp from 'app/widgets/ps-help';
  import PSSelect from 'app/widgets/ps-select';
  import PSButton from 'app/widgets/ps-button';
  import PSTable from 'app/widgets/ps-table/ps-table';
  import FormatLine from './format-line';

  export default {
    components: {
      PSHelp,
      PSSelect,
      PSButton,
      PSTable,
      FormatLine,
    },
  };
</script>
