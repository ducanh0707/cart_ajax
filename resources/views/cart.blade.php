@if(Session::has("Cart"))
<div class="select-items">
    <table>
        <tbody>
            @foreach(Session::get('Cart') ->products as $item)
            <tr>
                <td class="si-pic"><img src="public/assets/img/products/{{$item['productInfo']->img}}" alt=""></td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>₫ {{$item['productInfo']->price}} x {{$item['quanty']}}</p>
                        <h6>{{$item['productInfo']->name}}</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close"  data-id="{{$item['productInfo']->id}}"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="select-total">
    <span>total:</span>
    <h5>₫{{number_format(Session::get('Cart')->totalPrice)}}</h5>
    <input type="number" hidden id="total-quanty-cart" value="{{Session::get('Cart')->totalQuanty}}" >
</div>
@endif