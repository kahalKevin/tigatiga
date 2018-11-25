@if ($paginator->lastPage() > 1)
<div class="shop-breadcrumb-area" id="page-area">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-13">
            <ul class="pfolio-breadcrumb-list text-center">
            	<li class="float-left prev {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
			        <a href="{{ $paginator->url(1) }}">Prev</a>
			    </li>
			    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
			        <li class="float-left {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
			            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
			        </li>
			    @endfor
			    <li class="float-left next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
			        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
			    </li>                
            </ul>
        </div>
    </div>
</div>
@endif