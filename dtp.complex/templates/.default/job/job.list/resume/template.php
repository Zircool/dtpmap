<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
	<div class="list-panel">
		<a href="javascript:void(0);" class="grey-button">�����������</a><a href="javascript:void(0);" class="grey-button active">�������������</a>
		<a href="add/" class="green-button" style="float: right;">�������� ������</a>
		<div class="search-box-wrap">
			<div class="search-box">
				<input class="search-input" type="text" name="s" />
			</div>
			<input class="search-button" type="submit" value="�����"/>
		</div>
	</div>

<div class="list-wrap">
<?foreach($arResult["ITEMS"] as $arItem){?>
	<div class="list-row">
			<div class="list-row-cell first">
				<a href="javascript:void(0);" class="top-block-image"></a>
			</div><div class="list-row-cell second">
				<p><b><?=$arItem["NAME"]?></b></p>
				<p><a href="javascript:void(0);">������� ���</a></p>
				<p class="grey">�����</p>
			</div><div class="list-row-cell third">
				<p><b>�� 15 000 ���.</b></p>
				<p class="grey">���������</p>
			</div>
		</div>
<?}?>
	<center><a href="javascript:void(0);" class="grey-button">�������� ���</a></center>
</div>
