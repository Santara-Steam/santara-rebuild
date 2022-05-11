<div id="userData" class="hidden-display">{{Session::get("secondary_market")}}</div>
<input type="hidden" id="marketUrl" name="marketUrl" value="https://market.santara.co.id" />
<input type="hidden" id="key" name="key" value="{{env('PROJECT_DECRYPT_KEY')}}" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/aes.min.js" integrity="sha512-eqbQu9UN8zs1GXYopZmnTFFtJxpZ03FHaBMoU3dwoKirgGRss9diYqVpecUgtqW2YRFkIVgkycGQV852cD46+w==" crossorigin="anonymous"></script>
{{-- <script src="<?= base_url() ?>assets/js/member/redirect.js?v=<?= WEB_VERSION; ?>"></script> --}}
<script>
const userData = document.getElementById('userData').innerHTML;
const marketUrl = document.getElementById('marketUrl').value;
const key = document.getElementById('key').value;
const parseData = JSON.parse(userData);
const cookieName = '__AU2nQs04ys_';
const cookieRefresh = 'd0AIh0HgMW_';
const cookiePhoto = '_LOpSM4cK97';
const hostName = window.location.hostname;
const hostNameArray = hostName.split('.');

let cookieCrossDomain = '';

if (hostName === 'dev.santara.id' || hostName === 'https://dev.santara.id') {
  cookieCrossDomain = hostNameArray.length > 1
    ? `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 2)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
    : hostName; // get hostName if array length = 1, e.g. localhost
} else if (hostNameArray.length >= 3) {
  cookieCrossDomain = hostNameArray.length > 1
    ? `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 3)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.co.id) and append them with '.' (ASCII 46)
    : hostName; // get hostName if array length = 1, e.g. localhost
} else {
  cookieCrossDomain = hostNameArray.length > 1
    ? `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 2)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
    : hostName; // get hostName if array length = 1, e.g. localhost
}

const ciphertext = CryptoJS.AES.encrypt(
    JSON.stringify(parseData.token),
    key
  );

const ciphertextRefreshToken = CryptoJS.AES.encrypt(
    JSON.stringify(parseData.refresh_token),
    key
  );

const ciphertextPhoto = CryptoJS.AES.encrypt(
    JSON.stringify(parseData.photos),
    key,
  );

function saveCookies(cookiesName, data) {
  document.cookie = cookiesName+'='+data+";domain="+cookieCrossDomain+";path=/";
}

const url = `${marketUrl}/api/post/session`;
fetch(url, {
  method : "POST",
  body : JSON.stringify({
    token: ciphertext.toString(),
    expired_in: parseData.expired_in
  })
}).then(
    response => response.json()
).then(
    result => {
      if (result.token) {
        saveCookies(cookieName, result.token);
        saveCookies(cookieRefresh, ciphertextRefreshToken.toString());
        saveCookies(cookiePhoto, ciphertextPhoto.toString());
      }
      setTimeout(() => {
        window.location.href = `${marketUrl}/redirect/`;
      }, 1000);
    }
);

</script>