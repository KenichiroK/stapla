import "jquery-datetimepicker/build/jquery.datetimepicker.full";
import "jquery-datetimepicker/jquery";

$(function() {
  $("#contract_date_input").datetimepicker({
    timepicker: false,
    format: "Y-m-d",
    onChangeDateTime: function(dp, $input) {
      const targetElement = document.getElementById("c_contract_date_input");
      if ($input.val() && targetElement) {
        const dateString = new Date($input.val()).toLocaleDateString("ja-JP-u-ca-japanese", {
          era: "long",
          year: "numeric",
          month: "long",
          day: "numeric",
        });

        targetElement.textContent = dateString;
      } else {
        targetElement.textContent = "【契約締結日を入力してください】";
      }
    },
  });

  $("#calender_icon").on("click", function() {
    $("#contract_date_input").focus();
  });
});

document.getElementById("company_name").addEventListener("input", updateText);
document.getElementById("company_address").addEventListener("input", updateText);
document.getElementById("representive_name").addEventListener("input", updateText);
document.getElementById("partner_name").addEventListener("input", updateText);
document.getElementById("partner_address").addEventListener("input", updateText);
document.getElementById("court").addEventListener("change", updateSelect);

function updateText(e) {
  const targetElement = document.getElementById(`c_${e.target.id}`);
  // HACK: いけてない気もする
  const targetElement2 = document.getElementById(`c_${e.target.id}_2`);
  if (targetElement2) {
    targetElement2.textContent = e.target.value;
  }

  if (e.target.value && targetElement) {
    targetElement.textContent = e.target.value;
    return;
  }

  switch (e.target.id) {
    case "company_name":
      targetElement.textContent = "【企業名を入力してください】";
      targetElement2.textContent = "【企業名を入力してください】";
      break;

    case "partner_name":
      targetElement.textContent = "【パートナー名を入力してください】";
      targetElement2.textContent = "【パートナー名を入力してください】";
      break;

    case "company_address":
      targetElement.textContent = "【企業住所を入力してください】";
      break;

    case "representive_name":
      targetElement.textContent = "【企業代表者名を入力してください】";
      break;

    case "partner_address":
      targetElement.textContent = "【パートナ住所を入力してください】";
      break;

    default:
      break;
  }
}

function updateSelect(e) {
  const targetElement = document.getElementById(`c_${e.target.id}`);

  if (e.target.value && targetElement) {
    targetElement.textContent = `${e.target.value}地方裁判所`;
    return;
  }

  targetElement.textContent = "【裁判所を選択してください】";
}
