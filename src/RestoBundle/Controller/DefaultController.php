<?php

namespace RestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Dompdf\Dompdf;
use Dompdf\Options;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Resto/Default/index.html.twig');
    }

    public function adminHomeAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))){
            return $this->render('@Resto/Default/adminHome.html.twig');}
    }

    public function userHomeAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))){
            return $this->render('@Resto/Default/userHome.html.twig');}
    }

    public function pdfAction()
    {
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('RestoBundle:abonneresto:Pdf.html.twig', array(
            //..Send some data to your view if you need to //
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    public function myPdfAction()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('RestoBundle:abonneresto:mypdf.html.twig', [
            'title' => "Facture de Paiement"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
}
