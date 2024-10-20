import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'sarada-lite'),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'sarada-lite'),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Layout Settings", 'sarada-lite'),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.layout
        },
        {
            iconSvg: <Icon icon="frontpagesetting" />,
            heading: __("Appearance Settings", 'sarada-lite'),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.appr
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings"),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'sarada-lite'),
            buttonText: __('Customize', 'sarada-lite'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'sarada-lite'),
            para: __('Choose from different unique header layouts.', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'sarada-lite'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'sarada-lite'),
            para: __('Set different sidebars for posts and pages.', 'sarada-lite'),
            buttonText:  __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Top Bar Settings', 'sarada-lite'),
            para: __('Show a notice or newsletter at the top.', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'sarada-lite'),
            heading: __('Performance Settings', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Choose typography for different heading tags.', 'sarada-lite'),
            heading: __('Typography Settings', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'sarada-lite'),
            heading: __('One Click Demo Import', 'sarada-lite'),
            buttonText: __('Learn More', 'sarada-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'sarada-lite'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'sarada-lite'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'sarada-lite'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'sarada-lite'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'sarada-lite'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'sarada-lite'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'sarada-lite'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'sarada-lite'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'sarada-lite'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Sarada Lite Tutorial', 'sarada-lite')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/HLevD1OBp70?si=6O_LebAZTR4pmf58" title={__( 'How To Start A Fashion, Beauty Or Lifestyle Blog in 2023 | Sarada Lite', 'sarada-lite' )} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__( 'Quick Customizer Settings', 'sarada-lite' )}
                        buttonText={__( 'Go To Customizer', 'sarada-lite' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__( 'More features with Pro version', 'sarada-lite' )}
                        buttonText={__( 'Go To Customizer', 'sarada-lite' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'sarada-lite')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;