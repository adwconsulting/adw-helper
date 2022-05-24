@extends('layout.main')

@section('title')
Example Form
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">
    <a href="javascript:void(0)">Example Form</a>
</li>
@endsection

@section('action')
<a href="" class="btn btn-primary">Submit</a>
<a href="" class="btn btn-default">Cancel</a>
@endsection

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <form>
                <div class="form-group">
                    <label>Select2</label>
                    {!! Form::select('select2', ['Option 1' => 'Option 1', 'Option 2' => 'Option 2'], null, ['placeholder' => 'Select', 'data-input-type' => 'select2']); !!}
                </div>
                <div class="form-group">
                    <label>AutoNumeric</label>
                    {!! Form::text('textbox', null, ['class' => 'form-control', 'data-input-type' => 'autonumeric']) !!}
                </div>
                <div class="form-group">
                    <label>Datepicker</label>
                    {!! Form::text('datepicker', null, ['class' => 'form-control', 'data-input-type' => 'datepicker']) !!}
                </div>
                <div class="form-group">
                    <label>Clockpicker</label>
                    {!! Form::text('clockpicker', null, ['class' => 'form-control', 'data-input-type' => 'clockpicker']) !!}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="showBootboxModal()">Show Bootbox Modal</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="bootbox.alert('Bootbox alert message')">Show Bootbox Alert</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="bootboxConfirm('Are you sure you?', '{{ URL::to('/') }}')">Show Confirm Dialog</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="toastr.success('Success toast message')">Show Toast</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Date Time</th>
                        <th>Time</th>
                        <th>Human Date</th>
                        <th>Human Date Time</th>
                        <th>Number</th>
                        <th>Number Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="formatter-date"></td>
                        <td id="formatter-date-time"></td>
                        <td id="formatter-time"></td>
                        <td id="formatter-human-date"></td>
                        <td id="formatter-human-date-time"></td>
                        <td id="formatter-number"></td>
                        <td id="formatter-number-value"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('jsPage')
<script>
    function showBootboxModal() {
        bootbox.dialog({
            title: 'Bootbox Modal',
            message: "This is bootbox modal!",
            size: 'large'
        });
    }
    
    $(function() {
        $('#formatter-date').html(Formatter.date('2022-09-12')); 
        $('#formatter-date-time').html(Formatter.dateTime('2022-09-12 01:02:03')); 
        $('#formatter-time').html(Formatter.time('2022-09-12 01:02:03'));
        $('#formatter-human-date').html(Formatter.humanDate('2022-09-12 01:02:03')); 
        $('#formatter-human-date-time').html(Formatter.humanDateTime('2022-09-12 01:02:03'));
        $('#formatter-number').html(Formatter.number('10000000.00'));
        $('#formatter-number-value').html(Formatter.numberValue('10.000.000,00'));
    });
</script>
@endsection