$(function () {
  function invoiceShow() {
    let invoiceDefault = 5;
    const allListCount = $('.invoice-table > tbody').children('tr').length;
    const itemList = $('.invoice-table > tbody').children('tr');

    function defaultShowList() {
      itemList.hide();
      for (let i = 0; i < invoiceDefault; i++) {
        $(itemList[i]).show();
      }
    }

    function showMoreList() {
      $('#invoiceShowMoreBtn').on('click', () => {
        invoiceDefault += 4;
        for (let i = 0; i < invoiceDefault; i++) {
          $(itemList[i]).show();
        }
        hideShowMoreBtn();
      });
    }

    function hideShowMoreBtn() {
      if (invoiceDefault >= allListCount) {
        $('#invoiceShowMoreBtn').hide();
      }
    }
    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
  }
  invoiceShow();

  function orderShow() {
    let orderDefault = 5;
    const allListCount = $('.order-table > tbody').children('tr').length;
    const itemList = $('.order-table > tbody').children('tr');

    function defaultShowList() {
      itemList.hide();
      for (let i = 0; i < orderDefault; i++) {
        $(itemList[i]).show();
      }
    }

    function showMoreList() {
      $('#orderShowMoreBtn').on('click', () => {
        orderDefault += 4;
        for (let i = 0; i < orderDefault; i++) {
          $(itemList[i]).show();
        }
        hideShowMoreBtn();
      });
    }

    function hideShowMoreBtn() {
      if (orderDefault >= allListCount) {
        $('#orderShowMoreBtn').hide();
      }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
  }
  orderShow();

  function ndaShow() {
    let ndaDefault = 5;
    const allListCount = $('.nda-table > tbody').children('tr').length;
    const itemList = $('.nda-table > tbody').children('tr');

    function defaultShowList() {
      itemList.hide();
      for (let i = 0; i < ndaDefault; i++) {
        $(itemList[i]).show();
      }
    }

    function showMoreList() {
      $('#ndaShowMoreBtn').on('click', () => {
        ndaDefault += 4;
        for (let i = 0; i < ndaDefault; i++) {
          $(itemList[i]).show();
        }
        hideShowMoreBtn();
      });
    }

    function hideShowMoreBtn() {
      if (ndaDefault >= allListCount) {
        $('#ndaShowMoreBtn').hide();
      }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
  }
  ndaShow();


});
