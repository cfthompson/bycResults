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

function is_inrange(val, minval, maxval) {
	if (minval !== "") {
		if (val < parseInt(minval))
			return false;
		if (maxval !== "" && val > parseInt(maxval))
			return false;
	} else if (maxval !== "") {
		if (val > parseInt(maxval))
			return false;
	}
	return true;
}

var boatid = 0;

function boat_onChange() {
	var id = $(this).val();
	$("#entryboat").val(id);
	$("#entrysail").val(id);
	var boatspan = $("#boat_"+id);
	if (boatspan.length == 0) {
		entry_clearcalc();
		return;
	}
	var boatprops = boatspan.html().split("$$");
	var boatname = boatprops[0];         // 0 = name
	var sail = boatprops[1];             // 1 = sail
	var model = boatprops[2];            // 2 = model
	var phrf = parseInt(boatprops[3]);   // 3 = phrf
	var length = parseInt(boatprops[4]); // 4 = length
	$("#entrytype").html(model);
	$("#phrf").val(phrf);
	if (boatid !== id) {
		var rollFurl = boatprops[5];         // 5 = rollerFurling
		$("#rollerFurling").prop("checked", rollFurl == "1");
		boatid = id;
	}
	var divid = "";
	var divname = "";
	$(".division").each(function() {
		if (divid !== "") return;
		var tmpdivid = $(this).prop("id").split("_")[1];
		var divprops = $(this).html().split("$$");
		var tmpdivname = divprops[0];    // 0 = name
		var starttime = divprops[1];     // 1 = starttime
		var minphrf = divprops[2];       // 2 = minphrf
		var maxphrf = divprops[3];       // 3 = maxphrf
		var minlength = divprops[4];     // 4 = minlength
		var maxlength = divprops[5];     // 5 = maxlength
		if (is_inrange(phrf, minphrf, maxphrf) && is_inrange(length, minlength, maxlength)) {
			divid = tmpdivid;
			divname = tmpdivname;
		}
	});
	if (divid == "") {
		entry_clearcalc();
		return;
	}
	$("#division").html(divname);
	$("#divisionid").val(divid);
	$("#finish").focus();
}

function timeToSeconds(time) {
	var h, m, s;
	if (/\d{6}/.test(time)) {
		h = parseInt(time.substr(0, 2));
		m = parseInt(time.substr(2, 2));
		s = parseInt(time.substr(4, 2));
	} else if (/\d{2}:\d{2}:\d{2}/.test(time)) {
		h = parseInt(time.substr(0, 2));
		m = parseInt(time.substr(3, 2));
		s = parseInt(time.substr(6, 2));
	}
	if (h < 0 || m < 0 || s < 0 ||
		h > 23 || m > 59 || s > 59) {
		return -1;
	}
	var result = (h * 3600) + (m * 60) + s;
	return result;
}

function secondsToTime(seconds) {
	var h = parseInt(seconds/3600);
	seconds -= h*3600;
	var m = parseInt(seconds/60);
	seconds -= m*60;
	var s = seconds.toFixed(0);

	var str = "";
	if (h < 10) str += "0";
	str += h+":";
	if (m < 10) str += "0";
	str += m+":";
	if (s < 10) str += "0";
	str += s;

	return str;
}

function entry_recalc() {
	var divisionid = $("#divisionid").val();
	var phrf = $("#phrf").val();
	var spin = $("#spinnaker").prop("checked");
	var furl = $("#rollerFurling").prop("checked");
	var finish = $("#finish").val().toUpperCase();
	if (phrf == "" || divisionid == "") {
		entry_clearcalc(true);
		return false;
	}
	if (finish == 'DNF' || finish == 'DSQ') {
		entry_clearcalc(false);
		return true;
	}
	if (/^\d{6}$/.test(finish)) {
		str = finish.substr(0, 2) + ":"
			+ finish.substr(2, 2) + ":"
			+ finish.substr(4, 2);
		finish = str;
		$("#finish").val(finish);
	}
	if (!/^\d{2}:\d{2}:\d{2}$/.test(finish)) {
		entry_clearcalc(true);
		return false;
	}

	divisionid = parseInt(divisionid);
	phrf = parseInt(phrf);
	var divname = "";
	var starttime = "";
	var distance = 0.0;
	$(".division").each(function() {
		var tmpdivid = parseInt($(this).prop("id").split("_")[1]);
		if (tmpdivid !== divisionid) return;
		var divprops = $(this).html().split("$$");
		// divprops:
		// 0 = name
		// 1 = starttime
		// 2 = distance
		// 3 = minphrf
		// 4 = maxphrf
		// 5 = minlength
		// 6 = maxlength
		divname = divprops[0];
		starttime = divprops[1];
		distance = parseFloat(divprops[2]);
	});
	
	var tstart = timeToSeconds(starttime);
	var tfinish = timeToSeconds(finish);
	if (tstart < 0 || tfinish < 0) {
		entry_clearcalc(true);
		return false;
	}
	var elapsed = tfinish - tstart;
	var elapsedstr = secondsToTime(elapsed);
	$("#elapsed").html(elapsedstr);

	var method = $("#method").html();
	var param1 = $("#param1").html();
	var param2 = $("#param2").html();
	var corrected;
	if (method === 'TOT') {
		var tcf = parseFloat(param1)/(parseFloat(param2) + phrf);
		var tcfspin = spin ? 0.0 : 0.04*tcf;
		var tcffurl = furl ? 0.02*tcf : 0.0; 
		tcf -= tcfspin + tcffurl;
		$("#tcf").html(tcf.toFixed(2));
		corrected = elapsed * tcf;
	} else {
		$("#division").html(divname);
		if (!spin) phrf += 18;
		if (furl) phrf += 12;
		corrected = elapsed - (distance * phrf);
	}
	var correctedstr = secondsToTime(corrected);
	$("#corrected").html(correctedstr);
	$("#entry_submit").prop("disabled", false);
	return true;
}

function entry_clearcalc(disable_the_submit_button) {
	$("#elapsed").html("");
	$("#tcf").html("");
	$("#corrected").html("");
	$("#gap").html("");
	$("#entry_submit").prop("disabled", disable_the_submit_button);
}

function onEntrySubmit(event) {
	if (!entry_recalc()) {
		event.preventDefault();
		return;
	}
}

$(function() {
	$("#entrysail").change(boat_onChange);
	$("#entryboat").change(boat_onChange);
	var objs = $(".calcinput");
	objs.change(entry_recalc);
	$("#entry_submit").click(onEntrySubmit);
	boatid = $("#entrysail").val();
	$("#entrysail").trigger("change");
	entry_recalc();
});
