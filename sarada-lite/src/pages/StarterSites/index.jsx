import { Icon, Card } from "../../components";
import { __ } from "@wordpress/i18n";
import { mainDemo, demo2, demo3 } from "../../components/images";

const StarterSites = () => {
    const cardList = [
        {
            heading: __('Sarada', 'sarada-lite'),
            imageurl: mainDemo,
            buttonUrl: __('https://blossomthemesdemo.com/sarada/', 'sarada-lite'),
        },
        {
            heading: __('Travel (Gutenberg)', 'sarada-lite'),
            imageurl: demo2,
            buttonUrl: __('https://blossomthemesdemo.com/sarada-travel/', 'sarada-lite'),
        },
        {
            heading: __('Lifestyle (Gutenberg)', 'sarada-lite'),
            imageurl: demo3,
            buttonUrl: __('https://blossomthemesdemo.com/sarada-lifestyle/', 'sarada-lite'),
        },

    ]
    return (
        <>
            <Card
                cardList={cardList}
                cardPlace='starter'
                cardCol='three-col'
            />
            <div className="starter-sites-button cw-button">
                <a href={__('https://blossomthemes.com/theme-demo/?theme=sarada&utm_source=sarada_lite&utm_medium=dashboard&utm_campaign=theme_demo', 'sarada-lite')} target="_blank" className="cw-button-btn outline">
                    {__('View All Demos', 'sarada-lite')}
                    <Icon icon="arrowtwo" />
                </a>
            </div>
        </>
    );
}

export default StarterSites;