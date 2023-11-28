
<thead>
    <th>Item</th>
    <th>Amount and description</th>
    <th>Total</th>
</thead>

@php $n = 0 @endphp

@foreach($applicationBudgets as $budget)
    {{-- <tbody>
        <th>{{$budget->item}}</th>
        <th>{{$budget->amount_description}}</th>
        <th>{{$budget->total}}</th>
    </tbody> --}}

    <tbody>
        <tr>
            <td><input type="text" name="budget_{{$tableName}}_item-{{$n}}" id="budget_{{$tableName}}_item-{{$n}}" value="{{$budget->item}}"></td>
            <td><input type="text" name="budget_{{$tableName}}_amount_desc-{{$n}}" id="budget_{{$tableName}}_amount_desc-{{$n}}" value="{{$budget->amount_description}}"></td>
            <td><input type="text" name="budget_{{$tableName}}_total-{{$n}}" id="budget_{{$tableName}}_total-{{$n}}" value="{{$budget->total}}"></td>
            <td><button>Delete</button></td>
        </tr>
    </tbody>

    @php ++$n; @endphp

@endforeach
