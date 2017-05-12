<div class="col-sm-2">
<label>Navigation:</label>






<a href = "ar" class = "list-group-item <?php echo ($tab=="ar"?"active":""); ?>">Accounts Receivable</a>
<a href = "due" class = "list-group-item <?php echo ($tab=="due"?"active":""); ?>">Due <span class="badge"></span></a>
<a href = "30due" class = "list-group-item <?php echo ($tab=="30due"?"active":""); ?>" data-balloon="(1-30 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href = "60due" class = "list-group-item <?php echo ($tab=="60due"?"active":""); ?>" data-balloon="(31-60 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href = "61due" class = "list-group-item <?php echo ($tab=="61due"?"active":""); ?>" data-balloon="(over 61 Days)" data-balloon-pos="down">Past Due<span class="badge"></span></a>
<a href = "cashpaid" class = "list-group-item <?php echo ($tab=="cashpaid"?"active":""); ?>">Paid with Cash</a>
<a href = "pdcpaid" class = "list-group-item <?php echo ($tab=="pdcpaid"?"active":""); ?>">Paid with PDC</a>
<li class = "list-group-item"><input type="text" placeholder="Search DR" class="form-control"></li> 
</div>