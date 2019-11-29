<table width="100%" height="100" cellpadding="0" cellspacing="0" border="0" bgcolor="#eaeaea">
    <tbody style="background-color:#E7EDF3;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;">
    <tr>
        <td>
            <table width="800" height="1037" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#E7EDF3;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;">
                <tbody>
                <tr>
                    <td>
                        <!-- bgcolor="#1E91D6"  -->
                        <table width="480" cellpadding="0" cellspacing="0" bgcolor="#4D9DE0" border="0" align="center" style="border-radius:10px 10px 0 0; padding-top: 17px;">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="380" cellpadding="0" cellspacing="10" border="0" align="center" style="margin: 0;padding: 0 30px; width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td data-min="5" data-max="50" align="left" style="font-weight:500;font-size:18px;letter-spacing:0.100em;line-height:auto;color:#000;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;">
                                                <p style="font-family: BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 25px; color: #fff;">
                                                    Elosun
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="480" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff" style="border-radius:0 0 10px 10px;overflow:hidden;">
                            <tbody>
                            <tr>
                                <td style="padding-top:0;">
                                    <table cellpadding="" g="0" cellspacing="0" border="0" align="center" style="margin: 0 0 0 0;width:100%;">
                                        <tbody>
                                        <tr>
                                            <td class="head-mail" data-color="Text" data-size="Text" data-min="5" data-max="50" align="center" style="text-align:justify;font-weight:300;font-size:15px;letter-spacing:0.025em;line-height:26px;color:#686868;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;margin: 0;padding: 0 40px;">
                                                <div style="width:100%;display:block;float:left;font-size:14px;" align="center">
                                                    <p>
                                                        <b style="font-size: 20px;">Olá, {{$data['user']['name']}}!</b>
                                                        <br />
                                                        <br />
                                                        Você está recebendo este e-mail porque recebemos um pedido de {{$data['order']['type_order'] == 'sale' ? 'compra' : 'venda'}} de energia.
                                                        <br />
                                                        Para concluir o cadastro, clique no botão abaixo!
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0">
                                                <img
                                                    width="100"
                                                    height="100"
                                                    alt="sun icon"
                                                    title="Sun icon"
                                                    style="display:block"
                                                    src="https://estornoicms.com.br/img/lampada.png">
                                            </td>
                                        </tr>
                                        <tr><td height="36"></td></tr>
                                        <tr class="cent-itens" style="display:flex;align-items:center;-webkit-align-items:center;justify-content:center;-webkit-justify-content:center;flex-direction:row;-webkit-flex-direction:row;">
                                            <td class="raio raio1" style="display:block;float:left;width: 24%">
{{--                                                <img style="transform: rotate(75deg);width: 50%" src="https://st2.depositphotos.com/5934840/11671/v/950/depositphotos_116715510-stock-illustration-lightning-ray-icon.jpg" style="width:100px;" />--}}
                                            </td>
                                            <td class="td-pad10-30" align="center" style="float:left;">
                                                <a data-color="Button" data-size="Button" data-min="5" data-max="50" target="_blank" rel="noopener noref" href="{{url($data['url'])}}" style="font-weight:700;font-size:15px;letter-spacing:0.000em;line-height:auto;color:#294885;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;text-decoration:none;">
                                                    <table class="table-button220" width="250" height="45" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffc600" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;border-radius: 13px;">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center" valign="middle" style="padding-top:5px;padding-bottom:5px;padding-right:20px;padding-left:20px;">
                                                                Conclua seu cadastro...
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </a>
                                            </td>
                                            <td class="aviao aviao2" style="display:block;float:right;">
{{--                                                <img style="transform: rotate(255deg); width: 50%" src="https://st2.depositphotos.com/5934840/11671/v/950/depositphotos_116715510-stock-illustration-lightning-ray-icon.jpg" style="width:100px;">--}}
                                            </td>
                                        </tr>
                                        <tr><td height="60"></td></tr>
                                        <tr>
                                            <td align="center">
                                                <hr style="width: 95%;" color="#dbdbdb" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" border="0" align="center" style="font-family: 'Coolvetica', sans-serif; padding: 20px 0;">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <h3 style="color:#757575;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;text-align:center;">Você tem alguma dúvida?</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-color="Footer 01" data-size="Footer 01" data-min="5" data-max="50" class="td-pad10-20-wide" align="center" valign="top"
                                                            style="padding: 10px 0;font-weight:300;font-size:12px;letter-spacing:0.025em;line-height:24px;color:#9c9c9c;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;">
                                                            Visite o nosso site para dúvidas ou entre em contato!<br />
                                                            Atendimento de segunda à sexta, das 8:00 às 18:00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-color="Footer 02" data-size="Footer 01" data-min="5" data-max="50" class="td-pad10-20-wide" align="center" valign="top"
                                                            style="font-weight:300;font-size:12px;letter-spacing:0.025em;line-height:24px;color:#9c9c9c;font-family:&#39;Coolvetica&#39;, sans-serif;mso-line-height-rule:exactly;">
                                                            <a target="_blank" href="mailto:contato@elosun.com.br">contato@elosun.com.br</a><br />
                                                            Rua do Paissandu, 567 - Recife - PE<br />
                                                            (81) 4042.9770
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
