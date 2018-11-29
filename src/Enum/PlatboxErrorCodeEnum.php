<?php

namespace Platbox\Enum;

/**
 * Class PlatboxErrorCodeEnum
 *
 * @package Platbox\Structure\Errors
 */
class PlatboxErrorCodeEnum extends PlatboxEnum
{
    /**
     * Неверный формат сообщения
     */
    public const INVALID_REQUEST_FORMAT = 400;

    /**
     * Некорректная подпись запроса
     */
    public const BAD_SIGNATURE = 401;

    /**
     * Неверные данные запроса
     */
    public const INVALID_REQUEST_PARAMS = 406;

    /**
     * Значения полей запроса не соответствуют данным в системе мерчанта
     */
    public const BAD_REQUEST_PARAMS = 409;

    /**
     * Общая техническая ошибка
     */
    public const INTERNAL_ERROR = 1000;

    /**
     * Учётная запись пользователя не найдена или заблокирована
     */
    public const INVALID_ACCOUNT = 1001;

    /**
     * Неверная валюта платежа
     */
    public const INVALID_CURRENCY = 1002;

    /**
     * Неверная сумма платежа
     */
    public const INVALID_AMOUNT = 1003;

    /**
     * Запрашиваемые товары или услуги недоступны/выбранный продукт не найден/неверные данные заказа пользователя
     */
    public const INVALID_ORDER = 1005;

    /**
     * Платёж с указанным идентификатором уже зарезервирован
     */
    public const PAYMENT_ALREADY_BOOKED = 2000;

    /**
     * Платёж с указанным идентификатором уже проведен
     */
    public const PAYMENT_ALREADY_SUCCESS = 2001;

    /**
     * Платёж с указанным идентификатором уже отменён
     */
    public const PAYMENT_ALREADY_CANCELED = 2002;

    /**
     * Зарезервированная ранее транзакция устарела
     */
    public const PAYMENT_ALREADY_NOT_ACTIVE = 3000;
}
