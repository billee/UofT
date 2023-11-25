
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
                                        <table id="myTable">
                                            <thead>
                                                <th>Item</th>
                                                <th>Amount and description</th>
                                                <th>Total</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td><input type="text" name="budget_travel_item-0" id="budget_travel_item-0"></td>
                                                    <td><input type="text" name="budget_travel_amount_desc-0" id="budget_travel_amount_desc-0"></td>
                                                    <td><input type="text" name="budget_travel_total-0" id="budget_travel_total-0"></td>
                                                    <td><button>Delete</button></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>

                                        <div>
                                            <button type="button" class="btn btn-primary budget-travel-btn">
                                                Add
                                              </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat for other sections -->
                        </div>

                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>



<script type="text/javascript">

    //var addButton = document.querySelector(".budget-travel-btn");

    // addButton.addEventListener("click", function() {
    //     var table = document.querySelector("#myTable tbody");
    //     var rowCount = table.querySelectorAll("tr").length;

    //     var row = document.createElement("tr");

    //     var itemCell = document.createElement("td");
    //     var itemInput = document.createElement("input");
    //     itemInput.type = "text";
    //     itemInput.name = "budget_travel_item-" + rowCount;
    //     itemInput.id = "budget_travel_item-" + rowCount;
    //     itemCell.appendChild(itemInput);

    //     var amountCell = document.createElement("td");
    //     var amountInput = document.createElement("input");
    //     amountInput.type = "text";
    //     amountInput.name = "budget_travel_amount_desc-" + rowCount;
    //     amountInput.id = "budget_travel_amount_desc-" + rowCount;
    //     amountCell.appendChild(amountInput);

    //     var totalCell = document.createElement("td");
    //     var totalInput = document.createElement("input");
    //     totalInput.type = "text";
    //     totalInput.name = "budget_travel_total-" + rowCount;
    //     totalInput.id = "budget_travel_total-" + rowCount;
    //     totalCell.appendChild(totalInput);

    //     row.appendChild(itemCell);
    //     row.appendChild(amountCell);
    //     row.appendChild(totalCell);

    //     table.appendChild(row);
    // });

    var addButton = document.querySelector(".budget-travel-btn");

    addButton.addEventListener("click", function() {
        var table = document.querySelector("#myTable tbody");
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

    function reindexRows() {
        var table = document.querySelector("#myTable tbody");
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
