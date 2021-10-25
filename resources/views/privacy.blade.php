@extends('layouts.base')

@section('title', 'Privacy Policy')

@section('content')
    <div class="row flow-text">
        <div class="col s12 center">
            <h1>Privacy Policy for DuncteBot</h1>
            {{--<div>
                stored data:
                - guild ids
                - text channel ids
                - user ids
                - reminder messages
                - guild settings

                how taken care:
                - encrypted database
                - deleted when leaving guilds
            </div>--}}
            <div class="divider"></div>
        </div>
    </div>

    <div class="row">
        <!-- Lol I used a generator https://www.privacypolicygenerator.info/live.php?token=dBPJO0OG2Btagw7tM99qJfp4q0cGZ8A4 -->
       <div class="col s12">
           <p>At DuncteBot, accessible from dunctebot.com and duncte.bot, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by DuncteBot and how we use it.</p>

           <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

           <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in DuncteBot. This policy is not applicable to any information collected offline or via channels other than this website.</p>

           <h2>Consent</h2>

           <p>By using our website and our discord bot, you hereby consent to our Privacy Policy and agree to its terms.</p>

           <h2>Information we collect</h2>

           <p>The following data points are collected from users:</p>

           <ul>
               <li>Server ids</li>
               <li>Text channel ids</li>
               <li>Message ids</li>
               <li>User ids</li>
               <li>User tags (eg Example#0000)</li>
               <li>The reminders that a user created</li>
               <li>The custom settings a user can set for a guild</li>
               <li>The custom pronouns that a user can set</li>
               <li>Message content (ONLY if message logging is enabled)</li>
           </ul>

           <h2>Why we need your information</h2>

           <p>We need the information described above to provide the basic services we offer to you.</p>
           <p>We store the content of messages when message logging is enabled to provided the differences between edited messages and show the content of deleted messages.
           Since discord does not provide this data we are required to store it ourselves. <strong>All message content is stored in an encrypted database.</strong></p>

           <h2>How we use your information</h2>

           <p>We use the information we collect in the following ways:</p>

           <ul>
               <li>Provide, operate, and maintain our website and discord bot</li>
               <li>Provide all the functionalities that the bot has to offer</li>
           </ul>

           <p>WE DO NOT SHARE ANY OF THE STORED INFORMATION WITH ANY THIRD PARTIES</p>

           <h2>Log Files</h2>

           <p>DuncteBot follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info">Privacy Policy Generator</a> and the <a href="https://www.privacypolicyonline.com/privacy-policy-generator/">Online Privacy Policy Generator</a>.</p>

           <h2>Cookies and Web Beacons</h2>

           <p>Like any other website, DuncteBot uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

           <p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/">"What Are Cookies"</a>.</p>

           <p>If you have any concerns about your data you can always contact us on discord.</p>

           <h2>Data removal</h2>

           <p>The data removal process goes in two ways</p>

           <ul>
               <li>Discord server data (like custom server settings and temp bans)</li>
               <li>Discord user data (like reminders and pronouns)</li>
               <li>Message content data</li>
           </ul>

           <p>To get server data removed please contact us on discord, note that the data will be reset to the defaults automatically if the bot is still in your server.</p>

           <p>To get user data removed please contact us on discord.</p>

           <p>All message content will automatically be removed after 2 weeks.</p>

           <h2>Third Party Privacy Policies</h2>

           <p>DuncteBot's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

           <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

           <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

           <p>Under the CCPA, among other rights, California consumers have the right to:</p>
           <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
           <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
           <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
           <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

           <h2>GDPR Data Protection Rights</h2>

           <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
           <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
           <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
           <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
           <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
           <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
           <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
           <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

           <h2>Children's Information</h2>

           <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

           <p>DuncteBot does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
       </div>
    </div>
@endsection
