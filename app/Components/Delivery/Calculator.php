<?php

namespace AutoKit\Components\Delivery;

use AutoKit\Components\Cart\Cart;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Calculator extends Delivery
{
    private $areasSendId;
    private $areasResiveId;
    private $warehouseSendId;
    private $warehouseResiveId;
    private $insuranceValue;
    private $cashOnDeliveryValue;
    private $dateSend;
    private $deliveryScheme;
    private $category;
    private $dopUsluga;

    private $address;
    private $services;
    private $cart;

    public function __construct(DeliveryApiRequest $client, Address $address, Services $services, Cart $cart)
    {
        parent::__construct($client);
        $this->address = $address;
        $this->requestMethod = 'POST';
        $this->areasSendId = config('delivery.city_send_id');
        $this->warehouseSendId = config('delivery.warehouse_send_id');
        $this->cart = $cart;
        $this->services = $services;
    }

    /**
     * @return Collection
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function postReceiptCalculate(): Collection
    {
        return $this
            ->setUri(__METHOD__)
            ->addBodyData('culture', $this->culture)
            ->addBodyData('areasSendId', $this->areasSendId)
            ->addBodyData('areasResiveId', $this->areasResiveId)
            ->addBodyData('warehouseSendId', $this->warehouseSendId)
            ->addBodyData('warehouseResiveId', $this->areasResiveId)
            ->addBodyData('InsuranceValue', $this->insuranceValue)
            ->addBodyData('CashOnDeliveryValue', $this->cashOnDeliveryValue)
            ->addBodyData('dateSend', $this->dateSend)
            ->addBodyData('deliveryScheme', $this->deliveryScheme)
            ->addBodyData('category', $this->category)
            ->addBodyData('dopUslugaClassificator', $this->dopUsluga)
            ->send();
    }

    /**
     * @param string $warehouses
     * @return Calculator
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    public function setReceiveInfo(string $warehouses): self
    {
        $warehouses = $this->address->getWarehousesInfo($warehouses);
        $this->areasResiveId = $warehouses->get('CityId');
        $this->warehouseResiveId = $warehouses->get('id');
        $this->setInsuranceValue();
        return $this;
    }

    /**
     * @param $deliveryScheme
     * @return Calculator
     */
    public function setDeliveryScheme($deliveryScheme): self
    {
        $this->deliveryScheme = $deliveryScheme;
        return $this;
    }

    /**
     * @param string $category
     * @return Calculator
     */
    public function setCategory(string $category): self
    {
        $this->category = [[
            'categoryId' => $category,
            'countPlace' => 1,
            'helf' => $this->cart->totalWeight(),
            'size' => $this->cart->totalDimensions()
        ]];
        return $this;
    }

    /**
     * @param array $dopUsluga
     * @return Calculator
     */
    public function setDopUsluga(?array $dopUsluga): self
    {
        if (is_null($dopUsluga)) return $this;
        $arr = [];
        foreach ($dopUsluga as $usluga) {
            $arr[] = ['uslugaId' => $usluga, 'count' => 1];
        }
        $this->dopUsluga = [['dopUsluga' => $arr]];
        return $this;
    }

    /**
     * @return Calculator
     * @throws \AutoKit\Exceptions\DeliveryApi
     */
    private function setInsuranceValue(): self
    {
        $this->services->setReceiveInfo($this->warehouseSendId);
        $this->insuranceValue = $this->services->getInsuranceCost()->get('Value') + $this->cart->totalPrice();
        return $this;
    }

    /**
     * @return Calculator
     */
    public function setCashOnDeliveryValue(): self
    {
        $this->cashOnDeliveryValue = $this->cart->totalPrice();
        return $this;
    }

    /**
     * @return Calculator
     */
    public function setDateSend(): self
    {
        $this->dateSend = Carbon::tomorrow()->addHours(12)->format('d.m.Y');;
        return $this;
    }
}