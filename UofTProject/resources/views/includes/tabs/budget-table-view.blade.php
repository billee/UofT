
<thead>
    <th>Item</th>
    <th>Amount and description</th>
    <th>Total</th>
</thead>

@foreach($applicationBudgets as $budget)
    <tbody>
        <th>{{$budget->item}}</th>
        <th>{{$budget->amount_description}}</th>
        <th>{{$budget->total}}</th>
    </tbody>
@endforeach
