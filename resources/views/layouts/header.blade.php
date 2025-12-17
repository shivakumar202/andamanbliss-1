<section class="d-flex">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.menu')
        </div>

        <div class="custom-book-float d-none d-md-block">
            <div class="custom-book-icon p-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <span class="fw-bold">Request a Callback <i class="fa-solid fa-phone"></i></span>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade ad-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body  custom-modal-body p-0 m-0">
                        <form method="POST" action="{{ route('contact') }}" class="custom-form row g-1 p-3">
                            @csrf
                            <!-- This section will be hidden on small screens -->
                            <div class="col-lg-6 d-none d-lg-block custom-book-modal p-0">
                                <!-- Your content can be added here -->
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12 ">
                                <div class="px-2 mb-3">
                                    <input type="text" name="website" id="website" hidden>
                                    <div class="modal-header my-1 text-center bg-white py-1">
                                        <div class="d-flex justify-content-center">
                                            <h3 class="modal-title fw-bold text-center fs-5" id="staticBackdropLabel">Know
                                                Best Holiday Deals

                                            </h3>
                                        </div>
                                        <i type="button" data-bs-dismiss="modal" aria-label="Close"
                                            class="fa-solid fa-xmark text-dark" role="button"></i>
                                    </div>

                                    <div class="col-12 mb-3 mt-3">
                                        <input type="text" name="website" id="website" hidden>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                            required>
                                        @error('name')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input type="text" name="url" id="url" class="form-control d-none" value="{{ url()->current() }}" readonly>
                                    <div class="col-12  mb-3 mt-3 input-group">
                                        <select class="form-select form-select-sm rounded-0" name="code"
                                            id="contact_pre" aria-label="Country Code" required>
                                            <option value="+91" selected>+91</option>
                                            <option value="+1">+1</option>
                                            <option value="+7">+7</option>
                                            <option value="+20">+20</option>
                                            <option value="+27">+27</option>
                                            <option value="+30">+30</option>
                                            <option value="+31">+31</option>
                                            <option value="+32">+32</option>
                                            <option value="+33">+33</option>
                                            <option value="+34">+34</option>
                                            <option value="+36">+36</option>
                                            <option value="+39">+39</option>
                                            <option value="+40">+40</option>
                                            <option value="+41">+41</option>
                                            <option value="+43">+43</option>
                                            <option value="+44">+44</option>
                                            <option value="+45">+45</option>
                                            <option value="+46">+46</option>
                                            <option value="+47">+47</option>
                                            <option value="+48">+48</option>
                                            <option value="+49">+49</option>
                                            <option value="+51">+51</option>
                                            <option value="+52">+52</option>
                                            <option value="+53">+53</option>
                                            <option value="+54">+54</option>
                                            <option value="+55">+55</option>
                                            <option value="+56">+56</option>
                                            <option value="+57">+57</option>
                                            <option value="+58">+58</option>
                                            <option value="+60">+60</option>
                                            <option value="+61">+61</option>
                                            <option value="+62">+62</option>
                                            <option value="+63">+63</option>
                                            <option value="+64">+64</option>
                                            <option value="+65">+65</option>
                                            <option value="+66">+66</option>
                                            <option value="+81">+81</option>
                                            <option value="+82">+82</option>
                                            <option value="+84">+84</option>
                                            <option value="+86">+86</option>
                                            <option value="+90">+90</option>
                                            <option value="+91">+91</option>
                                            <option value="+92">+92</option>
                                            <option value="+93">+93</option>
                                            <option value="+94">+94</option>
                                            <option value="+95">+95</option>
                                            <option value="+98">++98</option>
                                            <option value="+211">++211</option>
                                            <option value="+212">++212</option>
                                            <option value="+213">+213</option>
                                            <option value="+216">+216</option>
                                            <option value="+218">+218</option>
                                            <option value="+220">+220</option>
                                            <option value="+221">+221</option>
                                            <option value="+222">+222</option>
                                            <option value="+223">+223</option>
                                            <option value="+224">+224</option>
                                            <option value="+225">+225</option>
                                            <option value="+226">+226</option>
                                            <option value="+227">+227</option>
                                            <option value="+228">+228</option>
                                            <option value="+229">+229</option>
                                            <option value="+230">+230</option>
                                            <option value="+231">+231</option>
                                            <option value="+232">+232</option>
                                            <option value="+233">+233</option>
                                            <option value="+234">+234</option>
                                            <option value="+235">+235</option>
                                            <option value="+236">+236</option>
                                            <option value="+237">+237</option>
                                            <option value="+238">+238</option>
                                            <option value="+239">+239</option>
                                            <option value="+240">+240</option>
                                            <option value="+241">+241</option>
                                            <option value="+242">+242</option>
                                            <option value="+243">+243</option>
                                            <option value="+244">+244</option>
                                            <option value="+245">+245</option>
                                            <option value="+246">+246</option>
                                            <option value="+248">+248</option>
                                            <option value="+249">+249</option>
                                            <option value="+250">+250</option>
                                            <option value="+251">+251</option>
                                            <option value="+252">+252</option>
                                            <option value="+253">+253</option>
                                            <option value="+254">+254</option>
                                            <option value="+255">+255</option>
                                            <option value="+256">+256</option>
                                            <option value="+257">+257</option>
                                            <option value="+258">+258</option>
                                            <option value="+260">+260</option>
                                            <option value="+261">+261</option>
                                            <option value="+262">+262</option>
                                            <option value="+263">+263</option>
                                            <option value="+264">+264</option>
                                            <option value="+265">+265</option>
                                            <option value="+266">+266</option>
                                            <option value="+267">+267</option>
                                            <option value="+268">+268</option>
                                            <option value="+269">+269</option>
                                            <option value="+290">+290</option>
                                            <option value="+291">+291</option>
                                            <option value="+297">+297</option>
                                            <option value="+298">+298</option>
                                            <option value="+299">+299</option>
                                            <option value="+350">+350</option>
                                            <option value="+351">+351</option>
                                            <option value="+352">+352</option>
                                            <option value="+353">+353</option>
                                            <option value="+354">+354</option>
                                            <option value="+355">+355</option>
                                            <option value="+356">+356</option>
                                            <option value="+357">+357</option>
                                            <option value="+358">+358</option>
                                            <option value="+359">+359</option>
                                            <option value="+370">+370</option>
                                            <option value="+371">+371</option>
                                            <option value="+372">+372</option>
                                            <option value="+373">+373</option>
                                            <option value="+374">+374</option>
                                            <option value="+375">+375</option>
                                            <option value="+376">+376</option>
                                            <option value="+377">+377</option>
                                            <option value="+378">+378</option>
                                            <option value="+379">+379</option>
                                            <option value="+380">+380</option>
                                            <option value="+381">+381</option>
                                            <option value="+382">+382</option>
                                            <option value="+385">+385</option>
                                            <option value="+386">+386</option>
                                            <option value="+387">+387</option>
                                            <option value="+389">+389</option>
                                            <option value="+420">+420</option>
                                            <option value="+421">+421</option>
                                            <option value="+423">+423</option>
                                            <option value="+500">+500</option>
                                            <option value="+501">+501</option>
                                            <option value="+502">+502</option>
                                            <option value="+503">+503</option>
                                            <option value="+504">+504</option>
                                            <option value="+505">+505</option>
                                            <option value="+506">+506</option>
                                            <option value="+507">+507</option>
                                            <option value="+508">+508</option>
                                            <option value="+509">+509</option>
                                            <option value="+590">+590</option>
                                            <option value="+591">+591</option>
                                            <option value="+592">+592</option>
                                            <option value="+593">+593</option>
                                            <option value="+594">+594</option>
                                            <option value="+595">+595</option>
                                            <option value="+596">+596</option>
                                            <option value="+597">+597</option>
                                            <option value="+598">+598</option>
                                            <option value="+599">+599</option>
                                            <option value="+670">+670</option>
                                            <option value="+971">+971</option>
                                            <option value="+972">+972</option>
                                            <option value="+973">+973</option>
                                            <option value="+974">+974</option>
                                            <option value="+975">+975</option>
                                            <option value="+976">+976</option>
                                            <option value="+977">+977</option>
                                        </select>
                                        <input type="text" name="mobile" id="mobile" placeholder="Contact Number"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="pCount d-flex justify-content-between">
                                            <div class="pCountall adult">
                                                <span>Adult</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="adult" value="{{ old('adult', 1) }}"
                                                        id="adult" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall child">
                                                <span>Child (2-5 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="child" value="{{ old('child', 0) }}"
                                                        id="child" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall infant">
                                                <span>Infant (0-2 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="infant" value="{{ old('infant', 0) }}"
                                                        id="infant" class="quantity__input" aria-label="Quantity">
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <input type="text" name="checkin" placeholder="dd-mm-yyyy" id="checkin"
                                            class="form-control" readonly>
                                        @error('date')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <select name="package" id="duration" class="form-control" aria-label="Select Package Duration" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="2N-3D">2Nights & 3Days</option>
                                            <option value="3N-4D">3Nights & 4Days</option>
                                            <option value="4N-5D">4Nights & 5Days</option>
                                            <option value="5N-6D">5Nights & 6Days</option>
                                            <option value="6N-7D">6Nights & 7Days</option>
                                            <option value="7N-8D">7Nights & 8Days</option>
                                            <option value="8N-9D">8Nights & 9Days</option>
                                            <option value="9N-10D">9Nights & 10Days</option>
                                            <option value="10+ Days">10+ Days</option>
                                            <option value="others">others</option>
                                        </select>
                                        @error('package')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <button type="submit"
                                            class="btn btn-lg default-btn fs-6 rounded-0 w-100 fw-bolder text-light justify-content-center">Enquire
                                            Now</button>
                                        <a type="button" href="tel:+918900909900"
                                            class="btn btn-lg call-btn fs-6 rounded-0 w-100 fw-bolder text-light mt-1 justify-content-center"><i
                                                class="fa-solid fa-phone"></i> +91 8900909900 </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- Expet Form --}}
        <div class="stick-bottom position-fixed  bottom-0 start-0 end-0 border-top d-md-none text-center d-flex" id="expert-btn" style="z-index: 9999;">
            <div class="col-6 bg-orange py-3 ">
                <a href="tel:+918900909900" class="fw-bold text-white fs-6">
                    <i class="fa-solid fa-phone"></i> Call Now
                </a>
            </div>
            <div class="col-6 bg-green py-3 ">
                <a href="https://wa.me/918900909900?text=Hi there! I'm interested in your Andaman tour packages. Could you help me with the details?" class="fw-bold text-white fs-6">
                    <i class="fa-brands fa-whatsapp"></i> Live Chat
                </a>
            </div>
        </div>
        <!-- <a role="button" href="#" data-bs-toggle="modal" id="expert-btn" data-bs-target="#Expert"
            class="stick-bottom position-fixed bottom-0 start-0 end-0 bg-info border-top py-2 d-md-none text-center"
            style="z-index: 9999;">
            <p class="w-100 text-white fw-bolder">Connect With An Expert</p>
        </a> -->
        <div class="modal fade" id="Expert" tabindex="-1" aria-labelledby="ExpertLabel" aria-hidden="true">
            <div class="modal-dialog m-0 modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h2 class="modal-title fs-5  text-white fw-bolder" id="ExpertLabel">Contact Us</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-0 ">
                        <form method="POST" action="{{ route('contact') }}" class="custom-form row g-1 ">
                            @csrf
                            <div class="col-12 ">
                                <div class="px-2 mb-3">
                                    <input type="text" name="website" id="website" hidden>

                                    <div class="col-12 mb-3 mt-3">
                                        <input type="text" name="website" id="website" hidden>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                            required>
                                        @error('name')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input type="text" name="url" id="url" class="form-control d-none" value="{{ url()->current() }}" readonly>
                                    <div class="col-12  mb-3 mt-3 input-group">
                                        <select class="form-select form-select-sm rounded-0" name="code"
                                            id="contact_pre" aria-label="Country Code"  required>
                                            <option value="+91" selected>+91</option>
                                            <option value="+1">+1</option>
                                            <option value="+7">+7</option>
                                            <option value="+20">+20</option>
                                            <option value="+27">+27</option>
                                            <option value="+30">+30</option>
                                            <option value="+31">+31</option>
                                            <option value="+32">+32</option>
                                            <option value="+33">+33</option>
                                            <option value="+34">+34</option>
                                            <option value="+36">+36</option>
                                            <option value="+39">+39</option>
                                            <option value="+40">+40</option>
                                            <option value="+41">+41</option>
                                            <option value="+43">+43</option>
                                            <option value="+44">+44</option>
                                            <option value="+45">+45</option>
                                            <option value="+46">+46</option>
                                            <option value="+47">+47</option>
                                            <option value="+48">+48</option>
                                            <option value="+49">+49</option>
                                            <option value="+51">+51</option>
                                            <option value="+52">+52</option>
                                            <option value="+53">+53</option>
                                            <option value="+54">+54</option>
                                            <option value="+55">+55</option>
                                            <option value="+56">+56</option>
                                            <option value="+57">+57</option>
                                            <option value="+58">+58</option>
                                            <option value="+60">+60</option>
                                            <option value="+61">+61</option>
                                            <option value="+62">+62</option>
                                            <option value="+63">+63</option>
                                            <option value="+64">+64</option>
                                            <option value="+65">+65</option>
                                            <option value="+66">+66</option>
                                            <option value="+81">+81</option>
                                            <option value="+82">+82</option>
                                            <option value="+84">+84</option>
                                            <option value="+86">+86</option>
                                            <option value="+90">+90</option>
                                            <option value="+91">+91</option>
                                            <option value="+92">+92</option>
                                            <option value="+93">+93</option>
                                            <option value="+94">+94</option>
                                            <option value="+95">+95</option>
                                            <option value="+98">++98</option>
                                            <option value="+211">++211</option>
                                            <option value="+212">++212</option>
                                            <option value="+213">+213</option>
                                            <option value="+216">+216</option>
                                            <option value="+218">+218</option>
                                            <option value="+220">+220</option>
                                            <option value="+221">+221</option>
                                            <option value="+222">+222</option>
                                            <option value="+223">+223</option>
                                            <option value="+224">+224</option>
                                            <option value="+225">+225</option>
                                            <option value="+226">+226</option>
                                            <option value="+227">+227</option>
                                            <option value="+228">+228</option>
                                            <option value="+229">+229</option>
                                            <option value="+230">+230</option>
                                            <option value="+231">+231</option>
                                            <option value="+232">+232</option>
                                            <option value="+233">+233</option>
                                            <option value="+234">+234</option>
                                            <option value="+235">+235</option>
                                            <option value="+236">+236</option>
                                            <option value="+237">+237</option>
                                            <option value="+238">+238</option>
                                            <option value="+239">+239</option>
                                            <option value="+240">+240</option>
                                            <option value="+241">+241</option>
                                            <option value="+242">+242</option>
                                            <option value="+243">+243</option>
                                            <option value="+244">+244</option>
                                            <option value="+245">+245</option>
                                            <option value="+246">+246</option>
                                            <option value="+248">+248</option>
                                            <option value="+249">+249</option>
                                            <option value="+250">+250</option>
                                            <option value="+251">+251</option>
                                            <option value="+252">+252</option>
                                            <option value="+253">+253</option>
                                            <option value="+254">+254</option>
                                            <option value="+255">+255</option>
                                            <option value="+256">+256</option>
                                            <option value="+257">+257</option>
                                            <option value="+258">+258</option>
                                            <option value="+260">+260</option>
                                            <option value="+261">+261</option>
                                            <option value="+262">+262</option>
                                            <option value="+263">+263</option>
                                            <option value="+264">+264</option>
                                            <option value="+265">+265</option>
                                            <option value="+266">+266</option>
                                            <option value="+267">+267</option>
                                            <option value="+268">+268</option>
                                            <option value="+269">+269</option>
                                            <option value="+290">+290</option>
                                            <option value="+291">+291</option>
                                            <option value="+297">+297</option>
                                            <option value="+298">+298</option>
                                            <option value="+299">+299</option>
                                            <option value="+350">+350</option>
                                            <option value="+351">+351</option>
                                            <option value="+352">+352</option>
                                            <option value="+353">+353</option>
                                            <option value="+354">+354</option>
                                            <option value="+355">+355</option>
                                            <option value="+356">+356</option>
                                            <option value="+357">+357</option>
                                            <option value="+358">+358</option>
                                            <option value="+359">+359</option>
                                            <option value="+370">+370</option>
                                            <option value="+371">+371</option>
                                            <option value="+372">+372</option>
                                            <option value="+373">+373</option>
                                            <option value="+374">+374</option>
                                            <option value="+375">+375</option>
                                            <option value="+376">+376</option>
                                            <option value="+377">+377</option>
                                            <option value="+378">+378</option>
                                            <option value="+379">+379</option>
                                            <option value="+380">+380</option>
                                            <option value="+381">+381</option>
                                            <option value="+382">+382</option>
                                            <option value="+385">+385</option>
                                            <option value="+386">+386</option>
                                            <option value="+387">+387</option>
                                            <option value="+389">+389</option>
                                            <option value="+420">+420</option>
                                            <option value="+421">+421</option>
                                            <option value="+423">+423</option>
                                            <option value="+500">+500</option>
                                            <option value="+501">+501</option>
                                            <option value="+502">+502</option>
                                            <option value="+503">+503</option>
                                            <option value="+504">+504</option>
                                            <option value="+505">+505</option>
                                            <option value="+506">+506</option>
                                            <option value="+507">+507</option>
                                            <option value="+508">+508</option>
                                            <option value="+509">+509</option>
                                            <option value="+590">+590</option>
                                            <option value="+591">+591</option>
                                            <option value="+592">+592</option>
                                            <option value="+593">+593</option>
                                            <option value="+594">+594</option>
                                            <option value="+595">+595</option>
                                            <option value="+596">+596</option>
                                            <option value="+597">+597</option>
                                            <option value="+598">+598</option>
                                            <option value="+599">+599</option>
                                            <option value="+670">+670</option>
                                            <option value="+971">+971</option>
                                            <option value="+972">+972</option>
                                            <option value="+973">+973</option>
                                            <option value="+974">+974</option>
                                            <option value="+975">+975</option>
                                            <option value="+976">+976</option>
                                            <option value="+977">+977</option>
                                        </select>
                                        <input type="text" name="mobile" id="mobile" placeholder="Contact Number"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="pCount d-flex justify-content-between">
                                            <div class="pCountall adult">
                                                <span>Adult</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="adult" value="{{ old('adult', 1) }}"
                                                        id="adult" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall child">
                                                <span>Child (2-5 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="child" value="{{ old('child', 0) }}"
                                                        id="child" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall infant">
                                                <span>Infant (0-2 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="infant" value="{{ old('infant', 0) }}"
                                                        id="infant" class="quantity__input" aria-label="Quantity">
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <input type="text" name="checkin" placeholder="yyyy-mm-dd" id="checkin"
                                            class="form-control" readonly>
                                        @error('date')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <select name="package" id="duration" class="form-control" aria-label="Package Duration" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="2N-3D">2Nights & 3Days</option>
                                            <option value="3N-4D">3Nights & 4Days</option>
                                            <option value="4N-5D">4Nights & 5Days</option>
                                            <option value="5N-6D">5Nights & 6Days</option>
                                            <option value="6N-7D">6Nights & 7Days</option>
                                            <option value="7N-8D">7Nights & 8Days</option>
                                            <option value="8N-9D">8Nights & 9Days</option>
                                            <option value="9N-10D">9Nights & 10Days</option>
                                            <option value="10+ Days">10+ Days</option>
                                        </select>
                                        @error('package')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="message" id="message" class="form-control"
                                            placeholder="Additional Prefrences" rows="10"></textarea>
                                    </div>

                                    <div class=" mt-3">
                                        <button type="submit"
                                            class="btn btn-lg default-btn fs-6 rounded-3 w-100 fw-bolder text-light justify-content-center">Send
                                            Enquiry</button>
                                        <hr class="text-dark my-2">
                                        <a type="button" href="tel:+918900909900"
                                            class="btn btn-lg call-btn fs-6 rounded-3 w-100 fw-bolder text-light mt-1  justify-content-center"><i
                                                class="fa-solid fa-phone"></i> +91 8900909900 </a>
                                        <a type="button" href="mailto:info@andamanbliss.com"
                                            class="btn btn-lg call-btn fs-6 rounded-3 w-100 fw-bolder text-light mt-1  justify-content-center"><i
                                                class="fa-solid fa-email"></i> info@andamanbliss.com </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    if (window.innerWidth >= 768 && !sessionStorage.getItem('modalShown')) {
    setTimeout(function() {
        var modal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();
        sessionStorage.setItem('modalShown', 'true');
    }, 5000);
}
</script>