
<style>
    .collapse {
        visibility: initial;
    }
    .accordion-body table thead {
        background-color: #000;
        color: #fff;
    }

    .accordion-body table th, .accordion-body table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .accordion-body table tr:hover {background-color: #ddd;}

    .accordion-body table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
    }
</style>

<div class="container py-5">
    <div id="dynamic-budget-fieldset">
        <fieldset class="mb-3 fieldset-budget-template">
            <div class="row mb-4">
                <div class="col-12 mt-4">
                    <div class="form-group">

                        <!-- accordion here -->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        Travel
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table id="TravelTable">
                                            @if('view' == $pageMode)
                                                @php
                                                    $applicationBudgets = $application->applicationBudgets->where('budget_category_id', 1) ?? '';
                                                @endphp
                                                @include('includes.tabs.budget-table-view', ['tableName' => 'travel'])
                                            @else
                                                @include('includes.tabs.budget-table')
                                            @endif
                                        </table>
                                        @if('create' == $pageMode)
                                            <div>
                                                <button type="button" type="background-color:blue" class="btn btn-primary budget-travel-btn">
                                                    Add
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingtwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Accommodation<i>based on double occupancy for students)</i>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table id="AccommodationTable">
                                            @if('view' == $pageMode)
                                                @php
                                                    $applicationBudgets = $application->applicationBudgets->where('budget_category_id', 2) ?? '';
                                                @endphp
                                                @include('includes.tabs.budget-table-view', ['tableName' => 'accommodation'])
                                            @else
                                                @include('includes.tabs.budget-table')
                                            @endif
                                        </table>
                                        @if('create' == $pageMode)
                                            <div>
                                                <button type="button" type="background-color:blue" class="btn btn-primary budget-accommodation-btn">
                                                    Add
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Food
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table id="FoodTable">
                                            @if('view' == $pageMode)
                                                @php
                                                    $applicationBudgets = $application->applicationBudgets->where('budget_category_id', 3) ?? '';
                                                @endphp
                                                @include('includes.tabs.budget-table-view', ['tableName' => 'food'])
                                            @else
                                                @include('includes.tabs.budget-table')
                                            @endif
                                        </table>
                                        @if('create' == $pageMode)
                                            <div>
                                                <button type="button" type="background-color:blue" class="btn btn-primary budget-food-btn">
                                                    Add
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        Other funds received or applied for
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table id="FundTable">
                                            @if('view' == $pageMode)
                                                @php
                                                    $applicationBudgets = $application->applicationBudgets->where('budget_category_id', 4) ?? '';
                                                @endphp
                                                @include('includes.tabs.budget-table-view', ['tableName' => 'fund'])
                                            @else
                                                @include('includes.tabs.budget-table')
                                            @endif
                                        </table>
                                        @if('create' == $pageMode)
                                            <div>
                                                <button type="button" type="background-color:blue" class="btn btn-primary budget-fund-btn">
                                                    Add
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<script type="text/javascript">

    // travel
    var addTravelButton = document.querySelector(".budget-travel-btn");
    addTravelButton.addEventListener("click", function() {
        var table = document.querySelector("#TravelTable tbody");
        var rowCount = table.querySelectorAll("tr").length;

        var row = document.createElement("tr");

        var itemCell = document.createElement("td");
        var itemInput = document.createElement("input");
        itemInput.type = "text";
        itemInput.name = "budget_travel_item-" + rowCount;
        itemInput.id = "budget_travel_item-" + rowCount;
        itemCell.appendChild(itemInput);

        var amountCell = document.createElement("td");
        var amountInput = document.createElement("input");
        amountInput.type = "text";
        amountInput.name = "budget_travel_amount_desc-" + rowCount;
        amountInput.id = "budget_travel_amount_desc-" + rowCount;
        amountCell.appendChild(amountInput);

        var totalCell = document.createElement("td");
        var totalInput = document.createElement("input");
        totalInput.type = "text";
        totalInput.name = "budget_travel_total-" + rowCount;
        totalInput.id = "budget_travel_total-" + rowCount;
        totalCell.appendChild(totalInput);

        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function() {
            table.removeChild(row);
            reindexRows();
        });
        deleteCell.appendChild(deleteButton);

        row.appendChild(itemCell);
        row.appendChild(amountCell);
        row.appendChild(totalCell);
        row.appendChild(deleteCell);

        table.appendChild(row);
    });

    //accommodation
    var addAccommodationButton = document.querySelector(".budget-accommodation-btn");
    addAccommodationButton.addEventListener("click", function() {
        var table = document.querySelector("#AccommodationTable tbody");
        var rowCount = table.querySelectorAll("tr").length;

        var row = document.createElement("tr");

        var itemCell = document.createElement("td");
        var itemInput = document.createElement("input");
        itemInput.type = "text";
        itemInput.name = "budget_accommodation_item-" + rowCount;
        itemInput.id = "budget_accommodation_item-" + rowCount;
        itemCell.appendChild(itemInput);

        var amountCell = document.createElement("td");
        var amountInput = document.createElement("input");
        amountInput.type = "text";
        amountInput.name = "budget_accommodation_amount_desc-" + rowCount;
        amountInput.id = "budget_accommodation_amount_desc-" + rowCount;
        amountCell.appendChild(amountInput);

        var totalCell = document.createElement("td");
        var totalInput = document.createElement("input");
        totalInput.type = "text";
        totalInput.name = "budget_accommodation_total-" + rowCount;
        totalInput.id = "budget_accommodation_total-" + rowCount;
        totalCell.appendChild(totalInput);

        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function() {
            table.removeChild(row);
            reindexRows();
        });
        deleteCell.appendChild(deleteButton);

        row.appendChild(itemCell);
        row.appendChild(amountCell);
        row.appendChild(totalCell);
        row.appendChild(deleteCell);

        table.appendChild(row);
    });

    //food
    var addFoodButton = document.querySelector(".budget-food-btn");
    addFoodButton.addEventListener("click", function() {
        var table = document.querySelector("#FoodTable tbody");
        var rowCount = table.querySelectorAll("tr").length;

        var row = document.createElement("tr");

        var itemCell = document.createElement("td");
        var itemInput = document.createElement("input");
        itemInput.type = "text";
        itemInput.name = "budget_food_item-" + rowCount;
        itemInput.id = "budget_food_item-" + rowCount;
        itemCell.appendChild(itemInput);

        var amountCell = document.createElement("td");
        var amountInput = document.createElement("input");
        amountInput.type = "text";
        amountInput.name = "budget_food_amount_desc-" + rowCount;
        amountInput.id = "budget_food_amount_desc-" + rowCount;
        amountCell.appendChild(amountInput);

        var totalCell = document.createElement("td");
        var totalInput = document.createElement("input");
        totalInput.type = "text";
        totalInput.name = "budget_food_total-" + rowCount;
        totalInput.id = "budget_food_total-" + rowCount;
        totalCell.appendChild(totalInput);

        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function() {
            table.removeChild(row);
            reindexRows();
        });
        deleteCell.appendChild(deleteButton);

        row.appendChild(itemCell);
        row.appendChild(amountCell);
        row.appendChild(totalCell);
        row.appendChild(deleteCell);

        table.appendChild(row);
    });

    //other funds
    var addFundButton = document.querySelector(".budget-fund-btn");
    addFundButton.addEventListener("click", function() {
        var table = document.querySelector("#FundTable tbody");
        var rowCount = table.querySelectorAll("tr").length;

        var row = document.createElement("tr");

        var itemCell = document.createElement("td");
        var itemInput = document.createElement("input");
        itemInput.type = "text";
        itemInput.name = "budget_fund_item-" + rowCount;
        itemInput.id = "budget_fund_item-" + rowCount;
        itemCell.appendChild(itemInput);

        var amountCell = document.createElement("td");
        var amountInput = document.createElement("input");
        amountInput.type = "text";
        amountInput.name = "budget_fund_amount_desc-" + rowCount;
        amountInput.id = "budget_fund_amount_desc-" + rowCount;
        amountCell.appendChild(amountInput);

        var totalCell = document.createElement("td");
        var totalInput = document.createElement("input");
        totalInput.type = "text";
        totalInput.name = "budget_fund_total-" + rowCount;
        totalInput.id = "budget_fund_total-" + rowCount;
        totalCell.appendChild(totalInput);

        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function() {
            table.removeChild(row);
            reindexRows();
        });
        deleteCell.appendChild(deleteButton);

        row.appendChild(itemCell);
        row.appendChild(amountCell);
        row.appendChild(totalCell);
        row.appendChild(deleteCell);

        table.appendChild(row);
    });



    function reindexRows() {
        var table = document.querySelector("#TravelTable tbody");
        var rows = Array.from(table.querySelectorAll("tr"));
        rows.forEach(function(row, index) {
            var inputs = Array.from(row.querySelectorAll("input"));
            inputs.forEach(function(input) {
                var baseId = input.id.split("-")[0];
                input.id = baseId + "-" + index;
                input.name = baseId + "-" + index;
            });
        });
    }

</script>
