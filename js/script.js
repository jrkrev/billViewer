/* todo: customize how the select options appear, dynamically generate
 * based on which checkbox is select... 
 */

$("document").ready
(
    function()
    { 
        // View Page
        
        $("#viewType").change(loadViewPage);
        
        $.ajax({"method":"POST", "url":"script/getDates.php"}).done
        (
            function(data)
            {         
                var result = JSON.parse(data);
                $("#earliestDate").val(result.date.earliest);
                $("#latestDate").val(result.now);
            }
        );
        
        $("#billSelect").change
        (
            function()
            {
                $("#billListDiv").hide();
                var billID = $("#billSelect").val();
                $.ajax
                (
                    {
                        "method":"POST",
                        "url":"script/getBill.php",
                        "data":
                        {
                            "id":billID
                        }
                    }
                ).done
                (
                    function(data)
                    {
                        var result = JSON.parse(data);
                        var billTableData = "<tr><th>Company</th>"
                        billTableData = billTableData + "<th>Recipient</th>" +
                                                        "<th>Amount</th>" +
                                                        "<th>Due</th>" +
                                                        "<th>Notes</th></tr>";
                        billTableData = billTableData + "<tr>" +
                                                        "<td>" + 
                                                        result.info.companyName + 
                                                        "</td>" +
                                                        "<td>" + 
                                                        result.info.accountNumber + 
                                                        "</td>" +
                                                        "<td>" + 
                                                        result.info.billAmount + 
                                                        "</td>" +
                                                        "<td>" +
                                                        result.info.billDate +
                                                        "</td>" +
                                                        "<td>" + 
                                                        result.info.billNote + 
                                                        "</td></tr>";
                        $("#viewBillInfo").html(billTableData);
                        
                        $("#earliestDate").val(result.date.earliest);
                        $("#latestDate").val(result.now);
                    }     
                );
                setTimeout  // Fixes a bug where info was not displaying.
                (
                    function()
                    {
                        var billID = $("#billSelect").val();
                        var dateFrom = $("#earliestDate").val();
                        var dateTo = $("#latestDate").val();

                        $.ajax
                        (
                            {
                                "method":"POST",
                                "url":"script/getBillAverage.php",
                                "data":
                                {
                                    "id":billID,
                                    "earliest":dateFrom,
                                    "latest":dateTo
                                }
                            }
                        ).done
                        (
                            function(data)
                            {
                                var result = JSON.parse(data);
                                $("#billCount").val(result.count._count);
                                $("#billSum").val(result.sum._sum);
                                $("#billMin").val(result.min._min);
                                $("#billMax").val(result.max._max);
                                $("#billAverage").val(result.avg._average);
                            }
                        );  
                    }, 50);
            }
        );

        $("#earliestDate, #lastestDate").change
        (
            function()
            {
                var billID = $("#billSelect").val();
                var dateFrom = $("#earliestDate").val();
                var dateTo = $("#latestDate").val();

                $.ajax
                (
                    {
                        "method":"POST",
                        "url":"script/getBillAverage.php",
                        "data":
                        {
                            "id":billID,
                            "earliest":dateFrom,
                            "latest":dateTo
                        }
                    }
                ).done
                (
                    function(data)
                    {

                        var result = JSON.parse(data);
                        $("#billAverage").val(result.avg._average);
                        $("#billCount").val(result.count._count);
                        $("#billMin").val(result.min._min);
                        $("#billMax").val(result.max._max);
                        $("#billSum").val(result.sum._sum);
                    }
                );
            }
        );

        $("#listBillsButton").click
        (
            function()
            {
                var billID = $("#billSelect").val();
                var dateFrom = $("#earliestDate").val();
                var dateTo = $("#latestDate").val();
                
                $.ajax
                (
                    {
                        "method":"POST",
                        "url":"script/getBillList.php",
                        "data":
                        {
                            "id":billID,
                            "earliest":dateFrom,
                            "latest":dateTo
                            
                        }
                    }
                ).done
                (
                    function(data)
                    {
                        var result = JSON.parse(data);
                        $("#billListDiv").show();
                        $("#billList").html("");
                        
                        var billList = "<tr><th colspan=\"2\">";
                        billList = billList + "Bills from " + 
                            result[0].companyName + " for " +
                            result[0].recipientFirstName + " " +
                            result[0].recipientLastName + " (Account No. " +
                            result[0].accountNumber + ")</th>" +
                            "</tr><tr>" + 
                            "<td colspan =\"2\">(From " + dateFrom + " to " +
                            dateTo + ")</td></tr><tr>" +
                            "<th>Amount</th>" +
                            "<th>Due Date</th></tr>";
                    
                        for(var count=0; count < result.length; count++)
                        {
                            billList = billList + 
                                "<td>" + result[count].billAmount +
                                "</td><td>" + result[count].billDate +
                                "</td></tr>";
                        }
                        $("#billList").html(billList);
                        
                    }
                    
                );
            }
        );

        $("#accountSelect").change
        (
            function()
            {
                var accountID = $("#accountSelect").val();
                $.ajax
                (
                    {
                        "method":"POST",
                        "url":"script/getAccount.php",
                        "data":
                        {
                            "id":accountID
                        }
                    }
                ).done
                (
                    function(data)
                    {
                        var result = JSON.parse(data);
                        var accountTable = "<tr><th>Company</th>" + 
                                "<th>Account Number</th><th>Recipient</th>" +
                                "<th>Notes</th></tr>";
                        accountTable = accountTable + "<tr><td>" + 
                                result.info.companyName + "</td><td>" +
                                result.info.accountNumber + "</td><td>" +
                                result.info.recipientFirstName + " " +
                                result.info.recipientLastName + "</td><td>" +
                                result.info.accountNote + "</td></tr>";
                        $("#viewAccountInfo").html(accountTable);
                                
                    }
                );
            }
        );

        $("#companySelect").change
        (
            function()
            {
                var companyID = $("#companySelect").val();
                $.ajax
                (
                    {
                        "method":"POST",
                        "url":"script/getCompany.php",
                        "data":
                        {
                            "id":companyID
                        }
                    }
                ).done
                (
                    function(data)
                    {
                        var result = JSON.parse(data);
                        var companyTable = "<tr><th>Company Name</th>" + 
                                "<th>Description</th><th>Contact Info</th>" +
                                "</tr>";
                        companyTable = companyTable + "<tr><td>" + 
                                result.info.companyName + "</td><td>" +
                                result.info.companyDescription + "</td><td>" +
                                result.info.companyContactInfo + "</td></tr>";
                        $("#viewCompanyInfo").html(companyTable);
                                
                    }
                );
            }
        );


        // Add Page
        
        $("#addType").change(loadAddPage);
        
        // Add button event handlers
        
        $("#addRecipientButton").click
        (
            function()
            {
                var recipientFirstName = $("#recipientFirstName").val();
                var recipientLastName = $("#recipientLastName").val();
                
                if(recipientFirstName && recipientLastName)
                {
                    $.ajax
                    (
                        {
                            "method":"POST",
                            "url":"script/addRecord.php",
                            "data":
                            {
                                "addType":"recipient",
                                "recipientFirstName":recipientFirstName,
                                "recipientLastName":recipientLastName,
                            }
                        }

                    ).done
                    (
                        function(data)
                        {
                            resetAddInputs();
                            $("#addRecipientDiv").hide();         
                            $("#added").show();
                        }
                    );
                }
                else
                    showInputError();
            }
        );
        
        $("#addCompanyButton").click
        (
            function()
            {
                var companyName = $("#companyName").val();
                var companyDescription = $("#companyDescription").val();
                var companyContactInfo = $("#companyContactInfo").val();
                
                if(companyName)
                {
                    $.ajax
                    (
                        {
                            "method":"POST",
                            "url":"script/addRecord.php",
                            "data":
                            {
                                "addType":"company",
                                "companyName":companyName,
                                "companyDescription":companyDescription,
                                "companyContactInfo":companyContactInfo
                            }
                        }

                    ).done
                    (
                        function(data)
                        {
                            resetAddInputs();
                            $("#addCompanyDiv").hide();         
                            $("#added").show();
                        }
                    );
                }
                else
                    showInputError();
            }
        );

        $("#addAccountButton").click
        (
            function()
            {
                var accountNumber = $("#accountNumber").val();
                var accountNote = $("#accountNote").val();
                var accountCompanyID = $("#account_companyID").val();
                var accountRecipientID = $("#account_recipientID").val();
                
                if(accountNumber && accountCompanyID && accountRecipientID)
                {
                    $.ajax
                    (
                        {
                            "method":"POST",
                            "url":"script/addRecord.php",
                            "data":
                            {
                                "addType":"account",
                                "accountNumber":accountNumber,
                                "accountNote":accountNote,
                                "accountCompanyID":accountCompanyID,
                                "accountRecipientID":accountRecipientID
                            }
                        }

                    ).done
                    (
                        function(data)
                        {
                            resetAddInputs();
                            $("#addAccountDiv").hide();         
                            $("#added").show();
                        }
                    );
                }
                else
                    showInputError();
            }
        );

        $("#addBillButton").click
        (
            function()
            {
                var billAmount = $("#billAmount").val();
                var billDate = $("#billDate").val();
                var billNote = $("#billNote").val();
                var billAccountID = $("#bill_accountID").val();    
                
                if(isValidAmount(billAmount) && billDate && billAccountID)
                {
                    $.ajax
                    (
                        {
                            "method":"POST",
                            "url":"script/addRecord.php",
                            "data":
                            {
                                "addType":"bill",
                                "billAmount":billAmount,
                                "billDate":billDate,
                                "billNote":billNote,
                                "billAccountID":billAccountID

                            }
                        }

                    ).done
                    (
                        function(data)
                        {
                            resetAddInputs();
                            $("#addBillDiv").hide();         
                            $("#added").show();
                        }
                    );
                }
                else
                    showInputError();
            }
        );

        $("#addDone").click
        (
            function()
            {
                loadAddPage();
            }
        );
        
        $("#deleteBillButton").click
        (
            function()
            {
                var billDeleteID = $("#billDeleteID").val();
                if(billDeleteID)
                {
                    $.ajax
                    (
                        {
                            "method":"POST",
                            "url":"script/deleteBill.php",
                            "data":
                            {
                                "billID":billDeleteID
                            }
                        }
                    ).done
                    (
                        function()
                        {
                            $("#deleteMenu").hide();
                            $("#deletedMessage").show();
                        }
                    );
                }
            }
            
        );
    }
);

function showInputError()
{
    $("#inputError").html("Please fill in required fields correctly.");
}

function clearInputError()
{
    $("#inputError").html("");
}

function resetAddInputs()
{
    clearInputError();
    $("#recipientFirstName").val("");
    $("#recipientLastName").val("");
    $("#companyName").val("");
    $("#companyDescription").val("");
    $("#companyContactInfo").val("");
    $("#accountNumber").val("");
    $("#accountNote").val("");
    $("#billAmount").val("");
    $("#billDate").val("");
    $("#billNote").val("");
}

function loadViewPage()
{
    $("#viewBillDiv").hide();
    $("#additionalInfo").hide();
    $("#billListDiv").hide();
    $("#viewAccountDiv").hide();
    $("#viewCompanyDiv").hide();
    $("#viewRecipientDiv").hide();
    
    switch($("#viewType").val())
    {
        case "bill":
            $("#viewBillDiv").show();
            $("#additionalInfo").show();
            break;
            
        case "account":
            $("#viewAccountDiv").show();
            break;
            
        case "company":
            $("#viewCompanyDiv").show();
            break;
            
        case "recipient":
            $("#viewRecipientDiv").show();
            break;
    }

}

function loadAddPage()
{
    clearInputError();
    $("#addRecipientDiv").hide();
    $("#addCompanyDiv").hide();
    $("#addAccountDiv").hide();
    $("#addBillDiv").hide();
    $("#added").hide();

    switch($("#addType").val())
    {
        case "recipient":
                        
            $("#addRecipientDiv").show();
            break;
                        
        case "company":
                     
            $("#addCompanyDiv").show();
            break;
                        
        case "account":
                        
            $.ajax
            (
                {
                    "method":"POST",
                    "url":"script/updateAddForm.php",
                    "data":{"addType":"account"}
                }
            ).done
            (
                function(data)
                {
                    var result = JSON.parse(data);
                    $("#account_companyID").html(result.company);
                    $("#account_recipientID").html(result.recipient);
                }
            );
                
            $("#addAccountDiv").show();
            break;
                        
        case "bill":
                        
            $.ajax
            (
                {
                    "method":"POST",
                    "url":"script/updateAddForm.php",
                    "data":{"addType":"bill"}
                }
            ).done
            (
                function(data)
                {
                    var result = JSON.parse(data);
                    $("#bill_accountID").html(result.bill);   
                }
            );
            $("#addBillDiv").show();
            break;
    }
}

function isValidAmount(value)
{
    var result = false;
    var amountRegEx = /^\d+(\.\d\d)?$/;
    if (value.match(amountRegEx))
        result = true;
    return result;
}