@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$orderTitle" />
<div class="flex flex-wrap justify-between mt-5 ">
    <?php
    $colors = ['blue', 'red', 'green', 'black'];    
    ?>
    @foreach($iconCard as $index => $icon)
        <x-Cards 
            :iconCard="$icon" 
            :nbr="$nbr[$index]" 
            :orderStat="$orderStat[$index]"  
            :color="$colors[$index]" 
        />
    @endforeach
    <div class="m-3 flex flex-col justify-end">
        <div class="">
            <h5 class="mb-3 text-md text-end  cursor-default  text-gray-600 dark:text-white">Views Orders 9/24 </h5>
        </div> 
        <x-Select  option="Default Sorting" name="Rating" />
        
    </div>
</div>
<div class="m-3 px-2 bg-white border border-gray-200 rounded-lg overflow-x-scroll w-full lg:w-auto shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-around text-xs lg:text-lg">
        <span class="text-regal-brown text-lg p-5">#ORDER</span>
        <span class="text-regal-brown text-lg p-5">PRODUCT</span>
        <span class="text-regal-brown text-lg p-5">CATEGORY</span>
        <span class="text-regal-brown text-lg p-5">PAYMENT METHOD</span>
        <span class="text-regal-brown text-lg p-5">ORDER STATUS</span>
        <span class="text-regal-brown text-lg p-5">RATE</span>
        <span class="text-regal-brown text-lg p-5">ACTIONS</span>
    </div>
    @if(isset($orders))
        @foreach($orders as $order)
            <x-admin.order 
                :id="$order->id" 
                :paymentMethod="$order->paymentMethod" 
                catImg="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEiklEQVR4nO2XWVMbRxSF+Q1Z/mVsjMCyJINWtLKNJJs4gaRcdhYTcGyXXwI2xNrFKsmAs/wAS0XJFNbCIh5uqlu6rRaZmcbdekil1FXn7dT0d7ruPYihocEZnMH5/x5/9LsvvdGFFZ+2WPdpi0Dk1RbAO9eVZ+5b8MyivgE30QzqAbiIpom+ZnJOEc0zTUTudxW+D+PhezAejp+Mh+I/2QLxz6UD+LTF5R5wrd/g8zrgHYWI4uAIxZ9IB/BqC7VPBXcz8AfXA4/og99FBWI1lQC94Bx838HDV8CDRDFwBGMgH4ADL737Gy4vL6larRZcXFzA2dkZNJtN2CkeMvDi4V+6vkazCdvFAzYuhYM/DX1bhX0KThWIygfgX/zqRaenpxS+0WjAx1qNvXhL4MPXFvkcgSiTfABuzslF5+fnPRfVajU4OTmB4+NjNi4iH46KyOcIRMFO5NfkA/BzjuNy9aJqtQpHR0ftOY/MC3044yKf3a8xyQfgKrFucFGlUoFypcIWU+RrL2hM6LP7NbARTc7JB+C7fHO3BNUPH3ouInpfLkMyu8WWM79TNPQlMpusWXImvjfpPNj8cxReLUC/ujwYY+DYLGzGA+05Zy/OgRPd8c2qBFAFj8uDT85SeKUAPHjRpLe3C/sMvLD/h3G/771l4Htv3xn6yLgivNU7oxYAX1zU2/jqIh++ushn9c1QeKUA/KiIehtHReTDZhH5rBR+mkotQOdXoqi3cc5FPpxxkc/qnYbbnrakA/ALKuptXFCRD5dT5LtN4aeo1AKE7tHZzgn6vd0sGuS2C4a+39N5tpzZrT1jXypHwcfcbckH6GOXd9VdTmtnznFU8MURfMwdoZIOoAw+qQY+5orAqEslAAdu1u+beyUGLep3BN8tHRr6yM8RAj7qClNJB+BfXNTb+OIiH766qe9jrQ3vDIPFGVIIwI2LqLdxVEQ+Oi7uKaHP0oFXCsDPuKi36Z9934zQh3Mu8lkI/ARRUCEAt6Ci3sblFPlwOet1E1+5QsFHOpIOgH/2ibLb5r2NzZLZ2jX0baSybDkzmztQrer43pdhPZlpw48TBRQC9LHLx7hWIcuJC2phoxJiL47gtzpSCtAf8F7464Lfukvklw/Ag//49CVspHOwkcnDejpH9Tqdg1epLDxeeUGbhYDvlA70+73RpD8zEP6HlRf630tm4dHSMwpONKwaAH+Xr3MX4WWvU1kaYC2VZS/eapn3O774etrke8ksBR92EE3KB+BHRe8iqmQG1pIZNiqifsdxEX1v2DFJdVMtQPsfCjLjRhcRrSbSbMZF/Y5zLvreTQJvJ/LJB+AXVO+itUSaXvbbmzRrFlG/44KSWX9l8j0CjlII0G2WR8vPYfXKRXjZw6VnbDnTeZN+T2RYszxc+hVWE/rf+/7npxT8hs1LJR2gn12O4NgsOOPDnTnnXxzBlQOMuiK1fnX59cB9/4K/YfMcqwT45VPBRwzB/cbgdj1wFuCxdACLa/oLizO8PDoRrjNwpx54sP/gd7z1r2yepZER12fSAQZncAZn6D9//gEllGM9Km8nygAAAABJRU5ErkJggg=="
                catName="Electronics"
                :state="$order->state" 
                :rate="$order->product->rating" 
                productImg="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEwklEQVR4nOXa6VNTVxjHcf+8On3TBVwqVZQt7EsIS/Z9JQsJCYsgtNbiUltFSy1upS12se2MrVDQYoEgYEHUQkGr7dM5z82995BckpB6znSmmfm+//xOnrzLrl3/t487EH3VHYrNu0OdkE2uIF1s25yBWNwdjO1mPsAVjMW7FkahD37Aekl/f48dxb7Dev4i3YRusRffQleizhffQOdzodjzr7Hw7BUyZI75APKqyWABmwrOqy6GvJpSRXD0T9JXWAd2g3wLwHwA+bpFrAyWX7eLYBPgCpcJKl0mZfCzGxCRGoPwszF+A+hzoMHi6wrgra8rg8ckcPjpl9BO5QxE+QxIPodMYAG7FRx6+gWENoWCm59j3AZEcwFvpoIDG6RRzL8xCg4/hwHkTgk48hLA/j8+gzap6/wGiGD6fmVsAryRGexbF/KuX8M4DYhmBAvYzGDv2jXwrF3F3GtX+Q2QwaPbgn1ZgN2/X8Fc2GWwt3WwH0BeSTwHGSxjfSJ2XcYKYBorgJ1PxEbA8WSE3wBF8Fo68GUKLGCxx5+CXeoSvwEvA2x7fAlsj4Ssjz7BbL4IjwEdivfrzAFsIa0OY+bVYbDyGEC+5u3A9kzg1a1g8+rHYHoodhGs3jCfAenAVgWwgB0G88OtYCNp5SIYVi5gFg+HAba2jpzARgWwYeUC6JeHMN3yEJg97RwG+CIUeOs5yGAZS4P1SWDd8nnQ/iZ2DkxuDgOs3oji/cpg6nVXhijweQp8DmslPfgIWhKZ3CH2AyzesOL90ueQLbjlwYfQvCTUtHQWjK4ghwGedsX7RTB1Dq1ZgJtIi2dBs/gBZnByGEB+aNmCmzOAG0kLZzD1whkwOAPsB5A7lc8hM1ijAFZLnYYG0n3SKdA7OAwwukIyeCkHMGJPQ/39U1J18ycxncPPY0BQPoclGZs1eF4G12KDUBsfhJr4IGjtHAaQH5qEXZTvN/kcZPBJCjxIgd/HqklzpBOgtbWxH0DuNB24LhkcVwKfwKqw96ByVqiVxwCdI5ARXEOD57YHV84ehwrSzHEon3kXWqw+DgPs/qzAVQrgiiRweSLVr+9gzRYv+wFae1t68Gx6sIoCl2EDUHZvAErvDUCT2cN+ALnTtOCZzGCCFeqHEtJ0PxRPH4NGk5v9AHKnqfebG7g4UdEvfZja6OIzQOl+pXOQwP0U+Jgi+AjWix2+2wsNBg4DmizebcElCuCi6T4KLGCP3CXgo1gh1gOFd3qgXu9kP0Bj9uwYfDgZfEcAH8K64SBpqhvqdA72AxqN7pzAhxTAb091SRVMdkKN1s5+gNrgUrzftOApZXDBZCccwGJw4OcYVLfa2A8gdyqCC/8l+C0sCvtJE1GoarGyH0DulAYfVAAXTGYH3j/RAfsS7R2PQGWzhf2AWq09AU593YIUbHrw3kR7xsOw53YYyjVm9gNqWm1pwFEKLGP3TSRhE+D82+1SeT+1g6rRxH4AudMU8MTOwHkIDmFvYkGsTG1kP4DcaQp4fOfgN34UC8DriUobDOwHlGvM8YLrgRRw/k7BtwLw2i2/VP6IB4rr9Oz/aqBSG3arGo1xlcaEN0sqw4xCaiOUShnwVUuSq9dDcXJ1+rmiet0rzAf81z7/AP/t0g928ZdVAAAAAElFTkSuQmCC"
                :productName="$order->product->name"
                />
            <hr class="my-5">
        @endforeach
    @endif
</div>
<x-Pagination />
@endsection
