<?php

return array(
  // タスクステータス 定数化
  'TASK_CREATE'             => 0,  // 下書き
  'TASK_SUBMIT_SUPERIOR'    => 1,  // 上長確認中
  'TASK_APPROVAL_SUPERIOR'  => 2,  // パートナー依頼前
  'TASK_SUBMIT_PARTNER'     => 3,  // パートナー確認中
  'TASK_APPROVAL_PARTNER'   => 4,  // 発注書作成前
  'ORDER_SUBMIT_SUPERIOR'   => 5,  // 上長確認中
  'ORDER_APPROVAL_SUPERIOR' => 6,  // パートナー依頼前
  'ORDER_SUBMIT_PARTNER'    => 7,  // パートナー確認中
  'ORDER_APPROVAL_PARTNER'  => 8,  // 作業前
  'WORKING'                 => 9,  // 作業中
  'DELIVERY_PARTNER'        => 10, // 検品中
  'ACCEPTANCE'              => 11, // 請求書作成前
  'INVOICE_DRAFT_CREATE'    => 12, // 請求書下書き
  'INVOICE_CREATE'          => 13, // 請求書担当者確認前
  'SUBMIT_STAFF'            => 14, // 請求書担当者確認中
  'SUBMIT_ACCOUNTING'       => 15, // 請求書経理提出
  'APPROVAL_ACCOUNTING'     => 16, // 請求書経理承認済み
  'COMPLETE_STAFF'          => 17, // 完了
  'TASK_CANCELED'           => 18, // キャンセル

  'TASK_STATUS_ARR' => [
    'TASK_CREATE',
    'TASK_SUBMIT_SUPERIOR',
    'TASK_APPROVAL_SUPERIOR',
    'TASK_SUBMIT_PARTNER',
    'TASK_APPROVAL_PARTNER',
    'ORDER_SUBMIT_SUPERIOR',
    'ORDER_APPROVAL_SUPERIOR',
    'ORDER_SUBMIT_PARTNER',
    'ORDER_APPROVAL_PARTNER',
    'WORKING',
    'DELIVERY_PARTNER',
    'ACCEPTANCE',
    'INVOICE_DRAFT_CREATE',
    'INVOICE_CREATE',
    'SUBMIT_STAFF',
    'SUBMIT_ACCOUNTING',
    'APPROVAL_ACCOUNTING',
    'COMPLETE_STAFF',
    'TASK_CANCELED',
  ],

  'TASK_STATUS_LIST' => [
    '下書き',
    '上長確認中',
    'パートナー依頼前',
    'パートナー確認中',
    '発注書作成前',
    '上長確認中',
    'パートナー依頼前',
    'パートナー確認中',
    '作業前',
    '作業中',
    '検品中',
    '請求書作成前',
    '請求書下書き',
    '請求書担当者確認前',
    '請求書担当者確認中',
    '請求書経理提出',
    '請求書経理承認済み',
    '完了',
    'キャンセル',
  ],

  // 消費税 定数化
  'FREE_TAX' => 0,
  'REDUCED_EIGHT_TAX' => 0.08,
  'TEN_TAX' => 0.1,
);
