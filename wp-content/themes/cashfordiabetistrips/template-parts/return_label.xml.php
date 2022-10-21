<?php ob_start(); ?>
<?xml version="1.0"?>
<USPSReturnsLabelCertifyRequest USERID="924KMEXP3273">
    <Option />
    <Revision></Revision>
    <ImageParameters>
        <ImageType>PDF</ImageType>
        <SeparateReceiptPage>false</SeparateReceiptPage>
    </ImageParameters>
    <CustomerFirstName>Cust First Name</CustomerFirstName>
    <CustomerLastName>Cust Last Name</CustomerLastName>    
</USPSReturnsLabelCertifyRequest>
<?php return ob_get_clean();
