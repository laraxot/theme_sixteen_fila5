<?php

declare(strict_types=1);

namespace Themes\Sixteen\Actions;

use DOMDocument;
<<<<<<< HEAD
use DOMElement;
=======
>>>>>>> laraxot/dev
use DOMXPath;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Spatie\QueueableAction\QueueableAction;

<<<<<<< HEAD
use function Safe\base64_decode;
use function Safe\gzdeflate;

/**
 * @phpstan-type SpidProvider array{name: string, entityId: string, sso_url: string, slo_url: string, cert: string, logo: string}
 */
=======
>>>>>>> laraxot/dev
class SpidAuthAction
{
    use QueueableAction;

<<<<<<< HEAD
    /** @var array<string, SpidProvider> */
=======
>>>>>>> laraxot/dev
    protected array $providers = [];

    protected string $entityId;

    protected string $assertionConsumerServiceUrl;

    protected string $singleLogoutServiceUrl;

    public function __construct()
    {
<<<<<<< HEAD
        $this->entityId = $this->configString('spid.entity_id', $this->configString('app.url', ''));
=======
        $this->entityId = config('spid.entity_id', config('app.url'));
>>>>>>> laraxot/dev
        $this->assertionConsumerServiceUrl = route('spid.callback');
        $this->singleLogoutServiceUrl = route('spid.slo');
        $this->loadProviders();
    }

    public function execute(): void {}

<<<<<<< HEAD
    /**
     * @return array<string, SpidProvider>
     */
=======
>>>>>>> laraxot/dev
    public function getProviders(): array
    {
        return $this->providers;
    }

    public function getLoginUrl(string $provider, int $level = 2, ?string $returnUrl = null): string
    {
        if (! isset($this->providers[$provider])) {
            throw new InvalidArgumentException("Provider SPID '{$provider}' non supportato");
        }

        $providerConfig = $this->providers[$provider];
        $requestId = $this->generateRequestId();

        Session::put('spid.request_id', $requestId);
        Session::put('spid.provider', $provider);
        Session::put('spid.return_url', $returnUrl ? $returnUrl : url()->previous());
        Session::put('spid.auth_level', $level);

        $samlRequest = $this->buildSamlAuthRequest($requestId, $providerConfig, $level);
        $encodedRequest = base64_encode(gzdeflate($samlRequest));

        return $providerConfig['sso_url'].'?'.http_build_query([
            'SAMLRequest' => $encodedRequest,
            'RelayState' => $requestId,
        ]);
    }

    public function getLogoutUrl(string $provider, string $nameId, string $sessionIndex): string
    {
        if (! isset($this->providers[$provider])) {
            throw new InvalidArgumentException("Provider SPID '{$provider}' non supportato");
        }

        $providerConfig = $this->providers[$provider];
        $requestId = $this->generateRequestId();

        Session::put('spid.logout_request_id', $requestId);

        $samlLogoutRequest = $this->buildSamlLogoutRequest($requestId, $nameId, $sessionIndex, $providerConfig);
        $encodedRequest = base64_encode(gzdeflate($samlLogoutRequest));

        return $providerConfig['slo_url'].'?'.http_build_query([
            'SAMLRequest' => $encodedRequest,
            'RelayState' => $requestId,
        ]);
    }

<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
=======
>>>>>>> laraxot/dev
    public function processCallback(Request $request): array
    {
        $samlResponse = $request->input('SAMLResponse');
        $relayState = $request->input('RelayState');

<<<<<<< HEAD
        if (! is_string($samlResponse) || $samlResponse === '') {
=======
        if (! $samlResponse) {
>>>>>>> laraxot/dev
            throw new Exception('SAMLResponse mancante');
        }

        if (! $relayState || $relayState !== Session::get('spid.request_id')) {
            throw new Exception('RelayState non valido');
        }

<<<<<<< HEAD
        $decodedResponse = base64_decode($samlResponse, true);
        if ($decodedResponse === '') {
            throw new Exception('SAMLResponse vuota');
        }

=======
        $decodedResponse = base64_decode($samlResponse);
>>>>>>> laraxot/dev
        $responseDoc = new DOMDocument();
        $responseDoc->loadXML($decodedResponse);

        $this->validateSamlResponse($responseDoc);

        $attributes = $this->extractUserAttributes($responseDoc);

        Log::info('SPID authentication successful', [
            'provider' => Session::get('spid.provider'),
            'user_attributes' => $attributes,
        ]);

        return $attributes;
    }

    public function getMetadata(): string
    {
        $metadata = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $metadata .= '<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata"'.PHP_EOL;
        $metadata .= '                     entityID="'.htmlspecialchars($this->entityId).'">'.PHP_EOL;

        $metadata .= '  <md:SPSSODescriptor AuthnRequestsSigned="true"'.PHP_EOL;
        $metadata .= '                      WantAssertionsSigned="true"'.PHP_EOL;
        $metadata .= '                      protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">'.PHP_EOL;

        $metadata .= '    <md:KeyDescriptor use="signing">'.PHP_EOL;
        $metadata .= '      <ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">'.PHP_EOL;
        $metadata .= '        <ds:X509Data>'.PHP_EOL;
        $metadata .= '          <ds:X509Certificate>'.$this->getSigningCertificate().'</ds:X509Certificate>'.PHP_EOL;
        $metadata .= '        </ds:X509Data>'.PHP_EOL;
        $metadata .= '      </ds:KeyInfo>'.PHP_EOL;
        $metadata .= '    </md:KeyDescriptor>'.PHP_EOL;

        $metadata .= '    <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"'.PHP_EOL;
        $metadata .= '                                 Location="'.htmlspecialchars($this->assertionConsumerServiceUrl).'"'.PHP_EOL;
        $metadata .= '                                 index="0" isDefault="true"/>'.PHP_EOL;

        $metadata .= '    <md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"'.PHP_EOL;
        $metadata .= '                           Location="'.htmlspecialchars($this->singleLogoutServiceUrl).'"/>'.PHP_EOL;

        $metadata .= '    <md:AttributeConsumingService index="0">'.PHP_EOL;
<<<<<<< HEAD
        $metadata .= '      <md:ServiceName xml:lang="it">'.htmlspecialchars($this->configString('app.name', '')).'</md:ServiceName>'.PHP_EOL;
=======
        $metadata .= '      <md:ServiceName xml:lang="it">'.config('app.name').'</md:ServiceName>'.PHP_EOL;
>>>>>>> laraxot/dev

        $spidAttributes = [
            'spidCode', 'name', 'familyName', 'placeOfBirth', 'countyOfBirth',
            'dateOfBirth', 'gender', 'companyName', 'registeredOffice',
            'fiscalNumber', 'ivaCode', 'idCard', 'mobilePhone', 'email',
            'address', 'digitalAddress',
        ];

        foreach ($spidAttributes as $attr) {
            $metadata .= '      <md:RequestedAttribute Name="'.$attr.'" NameFormat="urn:oasis:names:tc:SAML:2.0:attrname-format:basic"/>'.PHP_EOL;
        }

        $metadata .= '    </md:AttributeConsumingService>'.PHP_EOL;
        $metadata .= '  </md:SPSSODescriptor>'.PHP_EOL;
        $metadata .= '</md:EntityDescriptor>'.PHP_EOL;

        return $metadata;
    }

    public function isAuthenticated(): bool
    {
        return Session::has('spid.authenticated') && Session::get('spid.authenticated') === true;
    }

<<<<<<< HEAD
    /**
     * @return array<array-key, mixed>|null
     */
=======
>>>>>>> laraxot/dev
    public function getAuthenticatedUser(): ?array
    {
        if (! $this->isAuthenticated()) {
            return null;
        }

<<<<<<< HEAD
        $userData = Session::get('spid.user_data');

        return is_array($userData) ? $userData : null;
=======
        return Session::get('spid.user_data');
>>>>>>> laraxot/dev
    }

    public function logout(): void
    {
        Session::forget([
            'spid.authenticated',
            'spid.user_data',
            'spid.provider',
            'spid.request_id',
            'spid.auth_level',
        ]);
    }

    protected function loadProviders(): void
    {
<<<<<<< HEAD
        $configured = config('spid.providers');

        if (! is_array($configured)) {
            $this->providers = $this->defaultProviders();

            return;
        }

        $providers = [];
        foreach ($configured as $key => $provider) {
            if (! is_string($key) || ! is_array($provider)) {
                continue;
            }

            $providers[$key] = [
                'name' => $this->arrayString($provider, 'name'),
                'entityId' => $this->arrayString($provider, 'entityId'),
                'sso_url' => $this->arrayString($provider, 'sso_url'),
                'slo_url' => $this->arrayString($provider, 'slo_url'),
                'cert' => $this->arrayString($provider, 'cert'),
                'logo' => $this->arrayString($provider, 'logo'),
            ];
        }

        $this->providers = $providers;
    }

    /**
     * @return array<string, SpidProvider>
     */
    protected function defaultProviders(): array
    {
        return [
=======
        $this->providers = config('spid.providers', [
>>>>>>> laraxot/dev
            'poste' => [
                'name' => 'Poste Italiane',
                'entityId' => 'https://posteid.poste.it',
                'sso_url' => 'https://posteid.poste.it/jod-fs/ssoservicepost',
                'slo_url' => 'https://posteid.poste.it/jod-fs/sloservicepost',
                'cert' => 'poste.crt',
                'logo' => 'poste-logo.svg',
            ],
            'sielte' => [
                'name' => 'Sielte',
                'entityId' => 'https://identity.sieltecloud.it',
                'sso_url' => 'https://identity.sieltecloud.it/simplesaml/saml2/idp/SSOService.php',
                'slo_url' => 'https://identity.sieltecloud.it/simplesaml/saml2/idp/SingleLogoutService.php',
                'cert' => 'sielte.crt',
                'logo' => 'sielte-logo.svg',
            ],
            'tim' => [
                'name' => 'TIM Trust Technologies',
                'entityId' => 'https://login.id.tim.it/affwebservices/public/saml2sso',
                'sso_url' => 'https://login.id.tim.it/affwebservices/public/saml2sso',
                'slo_url' => 'https://login.id.tim.it/affwebservices/public/saml2slo',
                'cert' => 'tim.crt',
                'logo' => 'tim-logo.svg',
            ],
<<<<<<< HEAD
        ];
    }

    /**
     * @param  array<array-key, mixed>  $values
     */
    protected function arrayString(array $values, string $key): string
    {
        $value = $values[$key] ?? null;

        return is_string($value) ? $value : '';
    }

    protected function configString(string $key, string $default): string
    {
        $value = config($key);

        return is_string($value) ? $value : $default;
=======
        ]);
>>>>>>> laraxot/dev
    }

    protected function generateRequestId(): string
    {
        return 'req_'.bin2hex(random_bytes(16));
    }

<<<<<<< HEAD
    /**
     * @param  SpidProvider  $provider
     */
=======
>>>>>>> laraxot/dev
    protected function buildSamlAuthRequest(string $requestId, array $provider, int $level): string
    {
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');

        $request = '<samlp:AuthnRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL;
        $request .= '                   xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL;
        $request .= '                   ID="'.$requestId.'"'.PHP_EOL;
        $request .= '                   Version="2.0"'.PHP_EOL;
        $request .= '                   IssueInstant="'.$issueInstant.'"'.PHP_EOL;
        $request .= '                   Destination="'.$provider['sso_url'].'"'.PHP_EOL;
        $request .= '                   AssertionConsumerServiceURL="'.$this->assertionConsumerServiceUrl.'"'.PHP_EOL;
        $request .= '                   AttributeConsumingServiceIndex="0">'.PHP_EOL;

        $request .= '  <saml:Issuer>'.htmlspecialchars($this->entityId).'</saml:Issuer>'.PHP_EOL;

        $request .= '  <samlp:RequestedAuthnContext Comparison="minimum">'.PHP_EOL;
        $request .= '    <saml:AuthnContextClassRef>https://www.spid.gov.it/SpidL'.$level.'</saml:AuthnContextClassRef>'.PHP_EOL;
        $request .= '  </samlp:RequestedAuthnContext>'.PHP_EOL;

        $request .= '</samlp:AuthnRequest>';

        return $request;
    }

<<<<<<< HEAD
    /**
     * @param  SpidProvider  $provider
     */
=======
>>>>>>> laraxot/dev
    protected function buildSamlLogoutRequest(string $requestId, string $nameId, string $sessionIndex, array $provider): string
    {
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');

        $request = '<samlp:LogoutRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL;
        $request .= '                    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL;
        $request .= '                    ID="'.$requestId.'"'.PHP_EOL;
        $request .= '                    Version="2.0"'.PHP_EOL;
        $request .= '                    IssueInstant="'.$issueInstant.'"'.PHP_EOL;
        $request .= '                    Destination="'.$provider['slo_url'].'">'.PHP_EOL;

        $request .= '  <saml:Issuer>'.htmlspecialchars($this->entityId).'</saml:Issuer>'.PHP_EOL;
        $request .= '  <saml:NameID Format="urn:oasis:names:tc:SAML:2.0:nameid-format:transient">'.htmlspecialchars($nameId).'</saml:NameID>'.PHP_EOL;
        $request .= '  <samlp:SessionIndex>'.htmlspecialchars($sessionIndex).'</samlp:SessionIndex>'.PHP_EOL;

        $request .= '</samlp:LogoutRequest>';

        return $request;
    }

    protected function validateSamlResponse(DOMDocument $responseDoc): void
    {
        $xpath = new DOMXPath($responseDoc);
        $xpath->registerNamespace('samlp', 'urn:oasis:names:tc:SAML:2.0:protocol');
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');

        $statusCode = $xpath->query('//samlp:StatusCode/@Value');
<<<<<<< HEAD
        $statusNode = $statusCode === false ? null : $statusCode->item(0);
        if ($statusNode === null || $statusNode->nodeValue !== 'urn:oasis:names:tc:SAML:2.0:status:Success') {
=======
        if ($statusCode->length === 0 || $statusCode->item(0)->nodeValue !== 'urn:oasis:names:tc:SAML:2.0:status:Success') {
>>>>>>> laraxot/dev
            throw new Exception('SPID authentication failed');
        }
    }

<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
=======
>>>>>>> laraxot/dev
    protected function extractUserAttributes(DOMDocument $responseDoc): array
    {
        $xpath = new DOMXPath($responseDoc);
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');

        $attributes = [];

        $attributeNodes = $xpath->query('//saml:Attribute');
<<<<<<< HEAD
        if ($attributeNodes !== false) {
            foreach ($attributeNodes as $attributeNode) {
                if (! $attributeNode instanceof DOMElement) {
                    continue;
                }

                $name = $attributeNode->getAttribute('Name');
                $valueNodes = $xpath->query('saml:AttributeValue', $attributeNode);
                $valueNode = $valueNodes === false ? null : $valueNodes->item(0);

                if ($valueNode !== null) {
                    $attributes[$name] = $valueNode->nodeValue;
                }
=======
        foreach ($attributeNodes as $attributeNode) {
            $name = $attributeNode->getAttribute('Name');
            $valueNodes = $xpath->query('saml:AttributeValue', $attributeNode);

            if ($valueNodes->length > 0) {
                $attributes[$name] = $valueNodes->item(0)->nodeValue;
>>>>>>> laraxot/dev
            }
        }

        return [
            'spid_code' => $attributes['spidCode'] ?? null,
            'name' => $attributes['name'] ?? null,
            'surname' => $attributes['familyName'] ?? null,
            'fiscal_code' => $attributes['fiscalNumber'] ?? null,
            'email' => $attributes['email'] ?? null,
            'mobile' => $attributes['mobilePhone'] ?? null,
            'birth_date' => $attributes['dateOfBirth'] ?? null,
            'birth_place' => $attributes['placeOfBirth'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'address' => $attributes['address'] ?? null,
            'digital_address' => $attributes['digitalAddress'] ?? null,
            'company_name' => $attributes['companyName'] ?? null,
            'vat_number' => $attributes['ivaCode'] ?? null,
            'provider' => Session::get('spid.provider'),
            'auth_level' => Session::get('spid.auth_level', 2),
        ];
    }

    protected function getSigningCertificate(): string
    {
<<<<<<< HEAD
        return $this->configString('spid.signing_cert', '');
=======
        return config('spid.signing_cert', '');
>>>>>>> laraxot/dev
    }
}
