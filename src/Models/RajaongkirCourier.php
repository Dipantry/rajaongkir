<?php

/** @noinspection SpellCheckingInspection */

namespace Dipantry\Rajaongkir\Models;

use Dipantry\Rajaongkir\Helper\BasicEnum;

abstract class RajaongkirCourier extends BasicEnum
{
    /** POS Indonesia */
    const POS_INDONESIA = 'pos';

    /** Lion Parcel */
    const LION_PARCEL = 'lion';

    /** Ninja Xpress */
    const NINJA_XPRESS = 'ninja';

    /** ID Express */
    const ID_EXPRESS = 'ide';

    /** SiCepat Express */
    const SICEPAT = 'sicepat';

    /** SAP Express */
    const SAP_EXPRESS = 'sap';

    /** Nusantara Card Semesta */
    const NCS = 'ncs';

    /** AnterAja */
    const ANTERAJA = 'anteraja';

    /** Royal Express Indonesia */
    const REX = 'rex';

    /** Sentral Cargo */
    const SENTRAL = 'sentral';

    /** Jalur Nugraha Ekakurir */
    const JNE = 'jne';

    /** Citra Van Titipan Kilat */
    const TIKI = 'tiki';

    /** RPX Holding */
    const RPX = 'rpx';

    /** Pandu Logistics */
    const PANDU = 'pandu';

    /** Wahana Prestasi Logistik */
    const WAHANA = 'wahana';

    /** J&T Express */
    const JNT = 'j&t';

    /** Pahala Kencana Express */
    const PAHALA = 'pahala';

    /** JET Express */
    const JET = 'jet';

    /** Solusi Ekspres */
    const SOLUSI = 'slis';

    /** Expedito */
    const EXPEDITO = 'expedito';

    /** 21 Express */
    const EXPRESS_21 = 'dse';

    /** First Logistics */
    const FIRST = 'first';

    /** Star Cargo */
    const STAR = 'star';

    /** IDL Cargo */
    const IDL = 'idl';

    /** Indah Logistics */
    const INDAH = 'indah';
}
