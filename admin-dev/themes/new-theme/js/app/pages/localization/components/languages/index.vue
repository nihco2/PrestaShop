<template>
  <div id="languages">
    <div class="card p-2 clearfix">
      <h2>{{trans('title_languages')}}</h2>
      <LanguagesForm />
      <div class="float-sm-right">
        <PSButton ghost lg>{{trans('button_cancel')}}</PSButton>
        <PSButton primary lg>{{trans('button_save')}}</PSButton>
      </div>
    </div>
    <div class="card p-2 clearfix">
      <FormatTable />
      <div class="float-sm-right">
        <PSButton ghost lg>{{trans('button_cancel')}}</PSButton>
        <PSButton primary lg>{{trans('button_save')}}</PSButton>
      </div>
    </div>
  </div>
</template>

<script>
  import LanguagesForm from './languages-form';
  import FormatTable from './format-table';
  import PSButton from 'app/widgets/ps-button';

  export default {
    components: {
      LanguagesForm,
      PSButton,
      FormatTable,
    },
  };
</script>
