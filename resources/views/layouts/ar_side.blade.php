<div class="col-sm-2">
<label>Navigation:</label>
<a href="/receivables/ar" class = "list-group-item {{($tab=="ar"?"active":"")}}">Accounts Receivable</a>
<a href="/receivables/due" class = "list-group-item {{($tab=="due"?"active":"")}}">Due <span class="badge"></span></a>
<a href="/receivables/30due" class = "list-group-item {{($tab=="30due"?"active":"")}}" data-balloon="(1-30 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href="/receivables/60due" class = "list-group-item {{($tab=="60due"?"active":"")}}" data-balloon="(31-60 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href="/receivables/61due" class = "list-group-item {{($tab=="61due"?"active":"")}}" data-balloon="(over 61 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href="/receivables/cashpaid" class = "list-group-item {{($tab=="cashpaid"?"active":"")}}">Paid with Cash</a>
<a href="/receivables/pdcpaid" class = "list-group-item {{($tab=="pdcpaid"?"active":"")}}">Paid with PDC</a>
<li class = "list-group-item"><input type="text" placeholder="Search DR" class="form-control"></li> 
</div>