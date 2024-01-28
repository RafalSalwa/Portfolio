import default_1 from "@symfony/ux-turbo";

export default class streamFooter extends default_1 {
    static values = {
        className: String
    }

    click() {
        $(this.element).closest('#stream-footer').toggleClass("tools-stream tools-stream-collapsed");
        $(this.element).toggleClass('ion-arrow-right-a ion-arrow-left-a')
    }

}
