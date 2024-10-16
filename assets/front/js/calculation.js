function constantCalculation(qty = 0,p_id = 0,key = '') {
    // alert('gr:'+$('.g3').val());
    foreachInputFieldSetVariable();

    if(qty > 0){
        f3 = qty;
    }

    

    if(p_id > 0){
        pid = p_id;
    }

    
        
   
    var m3 = 'yes';
    var g5 = 'standard';
    var ab3 = 'no';
    // alert(constant.b11)
    //n3 = =IF(M3="Yes",0,IF(M3="No",10))
    n3 = (m3 == 'yes') ? 0 : 10;
    // $('#n3').val(n3);

    //here bseries value in cosntant like constant.b11 to constant.b163


    //o3 =IF(G5="standard",B61,IF(G5="premium",B62))/60

    o3 = (g5 == 'standard') ? parseFloat(constant.b61) : parseFloat(constant.b62);
    o3 = o3 / 60;
    // $('#o3').val(o3);

    //p3 =O3*30
    p3 = parseFloat(o3) * 30;
    // $('#p3').val(p3);
    // alert(g3);
    //q3 =IF(G3="regular",B14,IF(G3="3D",B15))
    q3 = (g3 == 'regular') ? parseFloat(constant.b14) : parseFloat(constant.b15);
    // $('#q3').val(q3);

    //r3 =IF(G3="3D",B13+(F3*0.1)-0.1,IF(G3="regular",B12+(F3*0.1)-0.1,""))
    r3 = (g3 == '3D') ? (parseFloat(constant.b13) + (f3 * 0.1) - 0.1) : (g3 == 'regular') ? (parseFloat(constant.b12) + (f3 * 0.1) - 0.1) : '';
    // $('#r3').val(r3);

    //s3 =B11+(F3*0.1)-0.1
    s3 = parseFloat(constant.b11) + (f3 * 0.1) - 0.1;
    // $('#s3').val(s3);

    //t3 =IF(AND(OR(H3="front center", H3="front left panel", H3="front right panel"), I3="No", K3="No"),B19, "0")
    t3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? parseFloat(constant.b19) : 0;
    // $('#t3').val(t3);

    //u3 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="regular",I3="No",K3="No"),B27*F3,IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="3D",I3="No",K3="No"),B35*F3,"0"))
    //console log all variable

    u3 = ((['front-center', 'front-left', 'front-right'].includes(h3) && g3 == 'regular' && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b27) * f3) : (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == '3D' && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b35) * f3) : 0);
    // $('#u3').val(u3);

    v3 = (f3 < parseFloat(constant.b137) ? parseFloat(constant.b46) * f3 : parseFloat(constant.b46) * parseFloat(constant.b137)) +
        (f3 < parseFloat(constant.b317) ? parseFloat(constant.b47) * f3 : parseFloat(constant.b47) * parseFloat(constant.b137)) +
        (f3 < parseFloat(constant.b317) ? parseFloat(constant.b48) * f3 : parseFloat(constant.b48) * parseFloat(constant.b137)) +
        (f3 < parseFloat(constant.b317) ? parseFloat(constant.b49) * f3 : parseFloat(constant.b49) * parseFloat(constant.b137)) +
        (f3 >= 1 ? parseFloat(constant.b50) : 0);
    // $('#v3').val(v3);


    //w3 = IF(AND(OR(H3 = "front center", H3 = "front left panel", H3 = "front right panel"), I3 = "No", K3 = "No"), B53 * INT((F3 - 1) / B137) + B53, "0")
    w3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b53) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b53)) : 0;
    // $('#w3').val(w3);

    //x3 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),I3="No",K3="No"),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/6)*B81))+(B102+(INT((F3-1)/6)*B102))+(F3*B70)+(B75*F3))),"0")
    x3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? (f3 > 0 ? ((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / 6) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / 6) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) : 0) : 0;

    // $('#x3').val(x3);

    //y3 =IF(G3="regular",B131*F3,IF(G3="3D",B132*F3))
    y3 = (g3 == 'regular') ? (parseFloat(constant.b131) * f3) : (g3 == '3D') ? (parseFloat(constant.b132) * f3) : 0;
    //round to 2 decimal
    // z3 = z3.toFixed(4);
    // $('#y3').val(y3);
// alert(g3);


    //t5 = IF(AND(I3 = "yes", K3 = "NO", OR(J3 = "right side", J3 = "left side"), OR(H3 = "front center", H3 = "front right panel", H3 = "front left panel")), B20, "0")
    let t5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b20) : 0;

    //t7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B21,"0")
    let t7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b21) : 0;

    //t9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B22,"0")
    let t9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b22) : 0;

    //t11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")), B23, "0")
    let t11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b23) : 0;

    //t13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")), B24, "0")
    let t13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b24) : 0;

    //u5 =IF(AND(I3="yes",K3="NO",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B28*F3,IF(AND(I3="yes",K3="NO",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),F3*B36,"0"))
    let u5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b28) * f3 : (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? f3 * parseFloat(constant.b36) : 0;

    //u7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B29*F3,IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B37*F3,"0"))
    let u7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b29) * f3 : (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b37) * f3 : 0;

    //u9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B30*F3,IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B38*F3,"0"))
    let u9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b30) * f3 : (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b38) * f3 : 0;

    //u11 =IF(AND(I3="yes",K3="yes",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B31*F3,IF(AND(I3="yes",K3="yes",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B39*F3,"0"))
    let u11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b31) * f3 : (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b39) * f3 : 0;

    //u13 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="regular",I3="No",K3="Yes"),B32*F3,IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="3D",I3="No",K3="Yes"),B40*F3,"0"))
    let u13 = (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == 'regular' && i3 == 'no' && k3 == 'yes') ? parseFloat(constant.b32) * f3 : (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == '3D' && i3 == 'no' && k3 == 'yes') ? parseFloat(constant.b40) * f3 : 0;

    //w5 =IF(AND(I3="yes",K3="NO", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),B54*INT((F3-1)/B137)+B54, "0")
    let w5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b54) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b54)) : 0;

    //w7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B55*INT((F3-1)/B137)+B55,"0")
    let w7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b55) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b55)) : 0;

    //w9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B57*INT((F3-1)/B137)+B57,"0")
    let w9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b57) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b57)) : 0;

    //w11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),B56*INT((F3-1)/B137)+B56,"0")
    let w11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b56) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b56)) : 0;

    //w13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")),B58*INT((F3-1)/B137)+B58,"0")
    let w13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b58) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b58)) : 0;

    //x5 =IF(AND(I3="yes",K3="NO", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)), "0")
    let x5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107))) : 0) : 0;

    //x7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)+(F3*B91)+(F3*B111)),"0")
    let x7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111))) : 0) : 0;

    //x9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)+(F3*B96)+(F3*B115)+(F3*B91)+(F3*B111)),"0")
    let x9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111))) : 0) : 0;

    //x11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B91)+(F3*B111)+(F3*B96)+(F3*B115)),"0")
    let x11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115))) : 0) : 0;

    //x13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B96)+(F3*B115)),"0")
    let x13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115))) : 0) : 0;



    //z3 =(T3+T5+T7+T9+T11+T13+U3+U5+U7+U9+U11+U13+V3+W3+W5+W7+W9+W11+W13+X3+X5+X7+X9+X11+X13+Y3-(U3/2))/60
    z3 = (t3 + t5 + t7 + t9 + t11 + t13 + u3 + u5 + u7 + u9 + u11 + u13 + v3 + w3 + w5 + w7 + w9 + w11 + w13 + x3 + x5 + x7 + x9 + x11 + x13 + y3 - (u3 / 2)) / 60;
    z3 = z3.toFixed(4);
    $('#z3').val(z3);

    //aa3 =Z3*15
    aa3 = parseFloat(z3) * 15;
    //round with 2 decimal
    //math round with 2 decimal

    aa3 = aa3.toFixed(2);

    $('#aa3').val(aa3);

    // console.log('aa3', aa3);
    //r3
    // console.log('r3', r3);
    //n3
    // console.log('n3', n3);
    //s3
    // console.log('s3', s3);
    //d3
    // console.log('d3', d3);
    //f3
    // console.log('f3', f3);
    //ac3 =(AA3+R3+N3+S3+(D3*F3))/F3

// alert(g3)



    ac3 = (parseFloat(aa3) + parseFloat(r3) + parseFloat(n3) + parseFloat(s3) + (parseFloat(d3) * parseFloat(f3))) / parseFloat(f3);
    //round with 2 decimal
    ac3 = ac3.toFixed(2);
    $('#ac3').val(ac3);
    // alert(ac3);

    //ad3 =P3+Q3
    ad3 = parseFloat(p3) + parseFloat(q3);
    //round with 2 decimal
    ad3 = ad3.toFixed(2);
    $('#ad3').val(ad3);

    //ae3 =(D3*F3)+N3+P3+Q3+AA53+R3+S3+AA3
    ae3 = (parseFloat(d3) * parseFloat(f3)) + parseFloat(n3) + parseFloat(p3) + parseFloat(q3) + parseFloat(aa3) + parseFloat(r3) + parseFloat(s3);
    //2 decimal only
    ae3 = ae3.toFixed(2);
    $('#ae3').val(ae3);


    //af3 =IF(F3<11,F3*10%,110%)
    af3 = (f3 < 11) ? (f3 * 0.1) : 1.1;
    // alert(af3);
    //round with 2 decimal
    af3 = af3.toFixed(2);
    $('#af3').val(af3);

    //ag3 =AE3+(AE3*AF3)
    ag3 = parseFloat(ae3) + (parseFloat(ae3) * parseFloat(af3));
    //round with 2 decimal
    ag3 = ag3.toFixed(2);
    $('#ag3').val(ag3);

    //ah3 =AG3-AE3
    ah3 = ag3 - ae3;
    //round with 2 decimal
    ah3 = ah3.toFixed(2);
    $('#ah3').val(ah3);

    //al3 =AG3/F3
    ai3 = ag3 / f3;
    //round with 2 decimal
    ai3 = ai3.toFixed(2);
    $('#ai3').val(ai3);

    //aj3 =IF(AB3="Yes",5,IF(AB3="No (Local Pickup)",0))
    aj3 = (ab3 == 'yes') ? 5 : 0;
    $('#aj3').val(aj3);
    // alert(aj3);
    //ak3 =AG3*8.25%
    ak3 = ag3 * 0.0825;
    //round with 2 decimal
    ak3 = ak3.toFixed(2);
    $('#ak3').val(ak3);

    //al3 =AG3+AK3+AJ3

    al3 = parseFloat(ag3) + parseFloat(ak3) + parseFloat(aj3);

    //round with 2 decimal
    al3 = al3.toFixed(2);
    // alert(al3);

    // $('#al3').text(al3);

    per_cap = al3 / f3;

    //round with 2 decimal
    per_cap = per_cap.toFixed(2);

if(key != ''){

    $('#price-'+key).html('$' + per_cap+'<input type="hidden" id="price-input-'+key+'" value="'+per_cap+'" name="price['+key+']">');
    
    $('#subtotal-' + key).html('$' + al3+'<input type="hidden" id="subtotal-input-'+key+'" value="'+al3+'" name="subtotal['+key+']">');
    $('#subtotal-' + key).attr('data-value',al3);
    

    var total = 0;
    $('.subtotal').each(function () {
        total += parseFloat($(this).attr('data-value'));
    });
    $('#total').html('$' + total.toFixed(2));
    $('#total_amount').val(total.toFixed(2));


    

}else{

    $('.price h3').html('$' + per_cap + ' per cap');
    $('.price').show();
}


    
    // alert(pid);
    saveToLocalStorage(pid);

    // loadFromLocalStorage(pid);



}



function saveToLocalStorage(productId) {
    // alert(productId);
    var g31 = $('.g3').val(); // Embroidery Type
    var h31 = $('.h3').val(); // Front Embroidery
    var i31 = $('.i3').val(); // Side Embroidery
    var j31 = $('.j3').val(); // Side Embroidery Location (if visible)
    var k31 = $('.k3').val(); // Back Embroidery
    var l31 = $('.l3').val(); // Back Embroidery Location (if visible)

    var quantity = $('.quantity-input').val();
    var itemsavedData = localStorage.getItem('product_items_' + productId);
    // console.log(itemsavedData);
    var color_ids = [];
    if (itemsavedData) {
        // alert('dfdfdfd');
        savedData = JSON.parse(itemsavedData);
        color_ids = savedData.color_id;
    }
    // alert(g3);
    var productData = {
        color_id: color_ids,
        embroidery_type: g31,
        front_embroidery: h31,
        side_embroidery: i31,
        side_embroidery_location: j31,
        back_embroidery: k31,
        back_embroidery_location: l31,
        quantity: quantity
    };

    // console.log(productData);


    // Saving to local storage
    localStorage.setItem('product_items_' + productId, JSON.stringify(productData));
   

}



function loadFromLocalStorage(productId) {
    // alert('dfd');
    // alert(productId);
    var itemsavedData = localStorage.getItem('product_items_' + productId);
    // console.log(itemsavedData);
    
    if (itemsavedData){
        // alert('dfdfdfd');
        savedData = JSON.parse(itemsavedData);
        
        console.log(savedData)
        // Set dropdown values
        $('.g3').val(savedData.embroidery_type || '');
        $('.h3').val(savedData.front_embroidery || '');
        $('.i3').val(savedData.side_embroidery || '');
        $('.j3').val(savedData.side_embroidery_location || '');
        $('.k3').val(savedData.back_embroidery || '');
        $('.l3').val(savedData.back_embroidery_location || '');


        var savedEmbroideryType = savedData.embroidery_type;

        $('.embBox').each(function () {
            // alert(savedEmbroideryType);
            if ($(this).data('value') === savedEmbroideryType) {
                $(this).addClass('embroselected');
                $(this).find('.checkbox').addClass('embroselected');

            } else {
                $(this).removeClass('embroselected'); // Optionally remove the class if it doesn't match
                $(this).find('.checkbox').removeClass('embroselected');

            }
        });

        var savedFrontEmbroidery = savedData.front_embroidery;

        $('.LogoBox').each(function () {
            if ($(this).data('value') === savedFrontEmbroidery) {
                $(this).addClass('logoPlaceSelected');
                $(this).find('.checkbox').addClass('logoPlaceSelected');
            } else {
                $(this).removeClass('logoPlaceSelected'); // Optionally remove the class if it doesn't match
                $(this).find('.checkbox').removeClass('logoPlaceSelected');
            }
        });

        // var savedFrontEmbroidery = savedData.front_embroidery;

        $('.LogoBox').each(function () {
            var dataValue = $(this).data('value');
            // alert(dataValue);
            // alert(savedData.side_embroidery_location);
            // alert(savedData.side_embroidery_location);
            // alert(savedData.side_embroidery_location);
            if (dataValue === savedData.side_embroidery_location || dataValue === savedData.back_embroidery_location) {
                // alert('fdf');
                $(this).addClass('logoselected');
                $(this).find('.checkbox').addClass('logoselected');
            } else if(savedData.side_embroidery_location === 'both'){
                document.querySelector('.LogoBox[data-id="logo1"]').classList.add('logoselected')
                $('.LogoBox[data-id="logo3"]').find('.checkbox').addClass('logoselected');
                document.querySelector('.LogoBox[data-id="logo3"]').classList.add('logoselected')
                $('.LogoBox[data-id="logo1"]').find('.checkbox').addClass('logoselected');

                
            }else{
                $(this).removeClass('logoselected'); // Optionally remove the class if it doesn't match
                $(this).find('.checkbox').removeClass('logoselected');
            }
        });


        // Set quantity
        $('.quantity-input').val(savedData.quantity || 1);

        if (savedData.side_embroidery == 'yes') {
            $('.side_location').show();
        } else {
            $('.j3').val('');
            $('.side_location').hide();
        }

        if (savedData.back_embroidery == 'yes') {
            $('.back_location').show();
        } else {
            $('.l3').val('');
            $('.back_location').hide();
        }

        var colors = savedData.color_id;
        var qty = savedData.quantity;
        // alert(colors);
        getallItems(colors,qty,token);

    }else{
    var savedDataa = localStorage.getItem('product_' + productId);
    // alert('gf')
        var colorIdArray = [];
    if (savedDataa) {
        savedDataa = JSON.parse(savedDataa);
        // console.log(savedDataa);

        // Set color
        if (savedDataa.color_id) {
            colorIdArray.push(savedDataa.color_id);
        }

        // Set dropdown values
        $('.g3').val(savedDataa.embroidery_type || '');
        $('.h3').val(savedDataa.front_embroidery || '');
        $('.i3').val(savedDataa.side_embroidery || '');
        $('.j3').val(savedDataa.side_embroidery_location || '');
        $('.k3').val(savedDataa.back_embroidery || '');
        $('.l3').val(savedDataa.back_embroidery_location || '');

        // Set quantity
        $('.quantity-input').val(savedDataa.quantity || 1);

        if (savedDataa.side_embroidery == 'yes') {
            $('.side_location').show();
        } else {
            $('.j3').val('');
            $('.side_location').hide();
        }

        if (savedDataa.back_embroidery == 'yes') {
            $('.back_location').show();
        } else {
            $('.l3').val('');
            $('.back_location').hide();
        }


        var productData = {
            color_id: colorIdArray,
            embroidery_type: savedDataa.embroidery_type,
            front_embroidery: savedDataa.front_embroidery,
            side_embroidery: savedDataa.side_embroidery,
            side_embroidery_location: savedDataa.side_embroidery_location,
            back_embroidery: savedDataa.back_embroidery,
            back_embroidery_location: savedDataa.back_embroidery_location,
            quantity: savedDataa.quantity
        };

        // console.log(productData);


        // Saving to local storage
        localStorage.setItem('product_items_' + productId, JSON.stringify(productData));

    }
}
    // console.log('Color IDs found in local storage:', colorIdArray);

}

function updatecolorIds(productId, colorId,qty,token) {
    // Get the existing product data from localStorage
    var storedData = localStorage.getItem('product_items_' + productId);
    var productData = storedData ? JSON.parse(storedData) : {};

    var colorIdArray = productData.color_id || []; // Retrieve colorIdArray or initialize as empty

    var index = colorIdArray.indexOf(colorId);
    if (index === -1) {
        // If it doesn't exist, push it to the array
        colorIdArray.push(colorId);
    } else {

        $('.color_' + colorId).each(function () {
            var allZero = true;  // Flag to check if all quantities are 0

            $(this).find('.quantity-input').each(function () {
                if ($(this).val() !== '0') {
                    allZero = false;  // If any value is not 0, set the flag to false
                }
            });

            
            if (allZero) {
                var index = colorIdArray.indexOf(colorId);
                if (index !== -1) {
                    colorIdArray.splice(index, 1);
                }
            }
        });
    
        }
    
    productData.colorIdArray = colorIdArray; // Update the colorIdArray

    // Save the updated product data back to localStorage
    localStorage.setItem('product_items_' + productId, JSON.stringify(productData));

    //settime out for getallitems

    setTimeout(() => {
    getallItems(colorIdArray, qty,token)
    }, 500);
}
 




function getvalue(id) {
    return parseFloat($('#' + id).val());
}

function foreachInputFieldSetVariable() {
    //get all input field value
    //foreach input field set variable using id
    $('input[type="text"]').each(function () {
        var id = $(this).attr('id');
        window[id] = getvalue(id);
    });

    $('input[type="hidden"]').each(function () {
        var id = $(this).attr('id');
        window[id] = getvalue(id);
    });

    //number field value
    $('input[type="number"]').each(function () {
        var id = $(this).attr('id');
        window[id] = getvalue(id);
    });

    //select field value
    $('select').each(function () {
        var id = $(this).attr('name');
        window[id] = $(this).val();
        $('.' + id).val(window[id]);
        
    });
}