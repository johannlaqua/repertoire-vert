////////////////////////////////////////////
$(".commande-data").click(function(){
    var id = $(this).attr('id');
    console.log('jai cliqué sur commande-data',$(this).attr('id'))
    $("#div-"+id).toggle()
    $("#input-adresse-"+id).toggle()
});

$('#addresse-identique').click(function(){
    console.log('jai cliqué sur' ,$(this).attr('id'));
        var coordonnees = $('.info-livraisons');
        coordonnees.css('display','none');
        console.log(coordonnees);

    $('#svg-radio-identique').html('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" width="100%" xml:space="preserve">\n' +
        '                                <g>\n' +
        '                                    <g>\n' +
        '                                        <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z"/>\n' +
        '                                    </g>\n' +
        '                                </g>\n' +
        '                            </svg>');


    $('#svg-radio-differente').html('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" width="100%" xml:space="preserve">\n' +
        '                            <g>\n' +
        '                                <g>\n' +
        '                                    <path d="M256,0C114.509,0,0,114.497,0,256c0,141.491,114.497,256,256,256c141.491,0,256-114.497,256-256    C512,114.509,397.503,0,256,0z M256,477.867c-122.337,0-221.867-99.529-221.867-221.867S133.663,34.133,256,34.133    S477.867,133.663,477.867,256S378.337,477.867,256,477.867z"/>\n' +
        '                                </g>\n' +
        '                            </g>\n' +
        '                        </svg>');
});

$('#addresse-differente').click(function(){
    console.log('jai cliqué sur' ,$(this).attr('id'));
    var coordonnees = $('.info-livraisons');
    coordonnees.css('display','block');
    console.log(coordonnees);
    $('#svg-radio-identique').html('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" width="100%" xml:space="preserve">\n' +
        '                            <g>\n' +
        '                                <g>\n' +
        '                                    <path d="M256,0C114.509,0,0,114.497,0,256c0,141.491,114.497,256,256,256c141.491,0,256-114.497,256-256    C512,114.509,397.503,0,256,0z M256,477.867c-122.337,0-221.867-99.529-221.867-221.867S133.663,34.133,256,34.133    S477.867,133.663,477.867,256S378.337,477.867,256,477.867z"/>\n' +
        '                                </g>\n' +
        '                            </g>\n' +
        '                        </svg>');



    $('#svg-radio-differente').html('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" width="100%" xml:space="preserve">\n' +
        '                                <g>\n' +
        '                                    <g>\n' +
        '                                        <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z"/>\n' +
        '                                    </g>\n' +
        '                                </g>\n' +
        '                            </svg>');
});