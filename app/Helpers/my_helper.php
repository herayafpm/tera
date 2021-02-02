<?php
function format_rupiah($angka)
{
  $rupiah = number_format($angka, 0, ',', '.');
  return $rupiah;
}
function get_pangkat()
{
  return [
    "IA",
    "IB",
    "IC",
    "ID",
    "IIA",
    "IIB",
    "IIC",
    "IID",
    "IIIA",
    "IIIB",
    "IIIC",
    "IIID",
    "IVA",
    "IVB",
    "IVC",
    "IVD",
    "IVE",
  ];
}
