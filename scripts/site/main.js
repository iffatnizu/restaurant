
var loding = '<div class="alert alert-warning">loading....</div>';

function successResult(msg)
{
    var success = '<div class="alert alert-success">' + msg + '</div>';
    return success;
}
function errorResult(msg)
{
    var error = '<div class="alert alert-danger">' + msg + '</div>';
    return error;
}
function getCityByState(id)
{
    $.ajax({
        type: "POST",
        url: base_url + "user/getCity",
        data: {
            "id": id
        },
        success: function(response)
        {
            //alert(response);
            $("select[name=city]").html("");
            var obj = $.parseJSON(response);
            $.each(obj, function(i, v) {
                var element = '<option value="' + v.cityId + '">' + v.cityName + '</option>';
                $("select[name=city]").append(element);
            })
        }
    });
}
function getSubcategory(id)
{
    //alert(id);
    if (id == "")
    {
        $("tr[id=subcatlist]").hide();
    }
    else {
        $.ajax({
            type: "POST",
            url: base_url + "business/getSubcategory",
            data: {
                "id": id,
                "submit": "1",
            },
            success: function(response)
            {
                //alert(response);
                $("tr[id=subcatlist]").show();
                
                $("td[id=sub-category]").html("");
                var obj = $.parseJSON(response);
                $.each(obj, function(i, v) {
                    var element = '<input type="checkbox" name="business-subcategory[]" value="' + v.subcategoryId + '"/> ' + v.subcategoryName + '<br/>';
                    $("td[id=sub-category]").append(element);
                })
            }
        });
    }
}
function addNewList()
{
    $("form[id=newList] span[class=error]").html("");
    var listname = $("form[id=newList] input[name=list-name]");

    if ($.trim(listname.val()) === "")
    {
        $("form[id=newList] span[class=error]").css("color", "red").html("Enter list name");
    }
    else {

        $(".ajax-content").html(loding);

        $.ajax({
            type: "POST",
            url: base_url + "lists/addnew/",
            data: {
                "submit": "1",
                "list-name": listname.val()
            },
            success: function(res)
            {
                if (res == '1')
                {
                    $(".ajax-content").html(successResult('Successfully added'));
                    listname.val("");
                }
                else
                {
                    $(".ajax-content").html(errorResult('Name already exist'));
                }

                setTimeout(function() {
                    $(".ajax-content").html("");
                }, 4000)


            }
        })
    }
    return false;
}
function loadList()
{
    $(".ajax-content").html(loding);

    $.ajax({
        type: "GET",
        url: base_url + "lists/userlist/",
        success: function(res)
        {
            $("#myLists").html("");

            $(".ajax-content").html("");
            //alert(res);
            var obj = $.parseJSON(res);

            $.each(obj, function(i, v) {
                var ht = '<tr><td>' + v.listName + '</td><td>' + v.date + '</td></tr>';
                $("#myLists").append(ht);
            })
        }
    })
}

function removeBizAttribute(id)
{
    //alert(id);
    $("span[id=sp-" + id + "]").remove();

}

var next = 2;

function addNewAtrribute()
{
    next += 1;

    //alert(next);

    var htm = '<span id="sp-' + next + '"><input id="t-' + next + '" style="width: 100px;" type="text" name="attribute-title[' + next + ']" placeholder="Title"/> <input id="v-' + next + '" style="width: 100px;" type="text" name="attribute-value[' + next + ']" placeholder="Value"/> <input id="b-' + next + '" class="btn btn-default" type="button" name="x" value="X" onclick="removeBizAttribute(' + next + ')"/><br class="clearfix"/></span>';
    $("td[id=attribute]").append(htm);

}

function putReserveMonth()
{
    $("tr[id=reservation]").show();
}
function removeReserveMonth()
{
    $("tr[id=reservation]").hide();
}

var menu = 0;
function AddMenu()
{
    menu += 1;

    //alert(next);

    var htm = '<span id="ml-' + menu + '"><input type="text" name="menu-title[' + menu + ']" placeholder="Title"/><br/><textarea placeholder="Details" name="menu-details[' + menu + ']"/><br/><input type="text" name="menu-price[' + menu + ']" placeholder="Price"/><br/><br/>.........<br/></span>';
    $("td[id=menu-list]").append(htm);

    $("#menu-status").show();
}

function removeMenu()
{
    $("td[id=menu-list] span").remove();
    $("#menu-status").hide();
}
function loadBusinessList()
{
    $(".ajax-content").html(loding);

    $.ajax({
        type: "GET",
        url: base_url + "business/businesslist/",
        success: function(res)
        {
            $("#myLists").html("");

            $(".ajax-content").html("");
            //alert(res);
            var obj = $.parseJSON(res);

            $.each(obj, function(i, v) {
                var ht = '<tr><td><a href="' + base_url + 'business/details/' + v.secret + '">' + v.businessTitle + '</a></td><td>' + v.date + '</td></tr>';
                $("#myLists").append(ht);
            })
        }
    })
}