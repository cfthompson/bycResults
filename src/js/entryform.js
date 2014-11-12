/* 
 * Copyright (C) 2014 rfgunion.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */

function boat_onChange() {
	var id = $(this).val();
	$("#entryboat").val(id);
	$("#entrysail").val(id);
	var boatspan = $("#boat_"+id);
	var boatprops = boatspan.html().split("$$");
	$("#entrytype").html(boatprops[2]);
	$("#phrf").val(boatprops[3]);
	$("#rollerFurling").prop("checked", boatprops[4] == "1");
}

function entry_recalc() {
	var phrf = $("#phrf").val();
	var spin = $("#spinnaker").checked;
	var furl = $("#rollerFurling").checked;
	var finish = $("#finish").val();
	if (phrf == "") {
		entry_clearcalc();
		return;
	}

	if (!/\d{6}/.test(finish)) {
		entry_clearcalc();
		return;
	}
	phrf = parseInt(phrf);
	var h = finish.substr(0, 2) - 13;
	var m = finish.substr(2, 2);
	var s = finish.substr(4, 2);
	var elapsed = parseInt(h*3600)+parseInt(m*60)+parseInt(s);

	$("#elapsed").html(""+h+":"+m+":"+s);
	var tcf = (550.0 + phrf);
	tcf = 800/tcf;
	var tcfspin = spin ? 0.0 : 0.04*tcf;
	var tcffurl = furl ? 0.02*tcf : 0.0; 
	$("#tcf").html((tcf - tcfspin - tcffurl).toFixed(2));
	var corrected = elapsed * tcf;
	var r = corrected % 3600;
	h = (corrected - r)/3600;
	corrected = r;
	r = corrected % 60;
	m = ((corrected - r)/60).toFixed(0);
	if (m < 10) m = "0"+m;
	s = r.toFixed(2);
	if (s < 10) s = "0"+s;
	$("#corrected").html(""+h+":"+m+":"+s);
}

function entry_clearcalc() {
	$("#elapsed").html("");
	$("#tcf").html("");
	$("#corrected").html("");
	$("#gap").html("");
}

$(function() {
	$("#entrysail").change(boat_onChange);
	$("#entryboat").change(boat_onChange);
})