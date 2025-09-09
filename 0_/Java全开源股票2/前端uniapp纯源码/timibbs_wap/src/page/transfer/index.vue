<template>
  <div class="wrapper">
<!--    <div class="header">-->
<!--      <div class="left_back" @click="handleBackClick()">-->
<!--        <img src="../../assets/img/zuojiantou.png" alt="">-->
<!--      </div>-->
<!--      <div class="header_titles">匯率轉換-->
<!--      </div>-->
<!--    </div>-->
    <div class="top_icon">
      <div class="left_back" @click="handleBackClick()">
        <img src="../../assets/img/zuojiantou.png" alt="">
      </div>
      <div class="title">{{$t('hj303')}}</div>
    </div>
<!--    新页面开始-->
    <van-row class="texBoxConver" style="margin-top: 2rem;">
      <van-popover
        v-model="showPopover"
        trigger="click"
        placement="bottom"
        :actions="actions"
        @select="onSelect"
      >

        <template #reference>
          <div class="texBoxConver_left">
            <img :src="coinImg"/>
          </div>
          <div class="texBoxConver_right">
            <span>{{ coinCode }}</span>
            <img src="data:image/png;base64,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">
          </div>
        </template>
      </van-popover>
      <div class="texBoxConver_content"><span data-v-40043be5="">{{ $t("hj328") }}: {{buyMoney}}</span></div>
      <div class="input_num">
        <input v-model="buyVal" type="number" :placeholder="$t('hj329')" @input="buyInput">
      </div>
    </van-row>

    <van-row class="arrow_split_down">
      <img src="data:image/png;base64,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">
    </van-row>

    <van-row class="texBoxConver">
      <van-popover
        v-model="showPopover1"
        trigger="click"
        placement="bottom"
        :actions="actions1"
        @select="onSelect1"
      >

        <template #reference>
          <div class="texBoxConver_left">
            <img :src="coinImg1"/>
          </div>
          <div class="texBoxConver_right">
            <span>{{ coinCode1 }}</span>
            <img src="data:image/png;base64,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">
          </div>
        </template>
      </van-popover>
      <div class="texBoxConver_content"><span data-v-40043be5="">{{ $t("hj328") }}: {{sellMoney}}</span></div>
      <div class="input_num"><input v-model="sellVal" type="number" :placeholder="$t('hj330')" disabled></div>
    </van-row>

    <van-row class="exchange_rate">
        <van-col span="12">
            <span style="font-size: 0.4rem;">{{ $t("hj305") }}</span>
        </van-col>

      <van-col span="11" class="exchange_rate_col_two">
        <div >1&nbsp;{{ coinCode }}</div>
        <div class="exchange_rate_col_two_divImg"><img data-v-40043be5="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAO4AAADICAYAAADvG90JAAAAAXNSR0IArs4c6QAAFGlJREFUeF7tnX20XFV5xt935t6QFLSIUGkRAaVoaflQqxWlmmRmEhJmJkEMIpHcM4nGIh9aCxU1OYQbLRaLlC8LWUnmTMJKurhtQmYmn3MmYYEN0lapWFBqWbjESnVVCSIQksx5u87M3JsbcufO195z9sw88wdcmL2f99m/9zxrz9c5hwkPEACBriPAXecYhkEABAjBxUEAAl1IAMHtwqbBMggguDgGQKALCSC4Xdg0EyxbSfciIhoSoeOIaB8x7/P/HWLZmN4SfcoEj73sAcHt5e4qXtv06XsGTj/u0PXEfAURnVNLXkSyHArd72QjI4otQK5KAMHFodAQgSWzd5xQmjLoEEmioQlE/iefe1jEXpuPfbvRORjXGAEEtzFOfT3qysTOM8IS/ndiOqEFEAdJxHbysa+3MBdTahBAcHFoTEpgKOkuZaH72sXERPkQi70mG3u8XS3ML7+awQMEahOwEkWXSCKKGO0jEtvJxe5SpNe3Mghu37a+/sIXxYvvD7E8Vn9kcyOY+AFmttdmZz7d3EyMHiWA4OJYqEnAShTuJOJrNSH6uRDZmVx0jSb9npZFcHu6ve0tzkq40p5C/dlMnA4PhuzVm2b8rP5ojMCOi2NgUgLW/D3HU6n0Qocw/ZiYbCcb/ccO1ev6Mthxu76FehZgzd9+OpUGn9WjXkOV6Z7wa4fsNTsv+nVH63ZhMQS3C5vWCcvW3F3nUzgUxFc33xfPszNbZ2U7sc5urYHgdmvnNPu24oXpxLxHc5na8izfeMPBg8vv2j73tcA8GFwYwTW4OUFbsxLu94no3MB8MO0VL2Rn8jOLgXkwtDCCa2hjTLA1FHevZqa7A/civMLJR24O3IdBBhBcg5phmpVF8eIpIZYfE9G0oL2JkP/dlL0uH300aC8m1EdwTeiCwR6seGEFMd9khEWh/eWfTOZj3zDCT4AmENwA4XdLaaPCW4G2xWOy12WjT3QLQ9U+EVzVRHtUz8Dw/oqIbCcX/VaPIp90WQhuP3a9xTVbycJiEh4molNalFA+TUg2lrhk35+96L+VixssiOAa3BwTrS26xD0rdIj88H7cHH/yXOV0wVmOOZ70OkFw9fLtWXUrUbiWqLz7Hm/KIpl49eDgoL1q04efN8WTLh8Iri6yfaC7JFl4d0loJRFfbM5y+UeVExZ6+0J1CK45R1zXOrHixRspRMMkMmjKIpjozsFXxV7lxl40xZNKHwiuSpp9rLU4vudCj0sriWi6QRi+Jyx2JhvbapAnJVYQXCUYITJKYChZXMkiy0wiwky3nPabsL3ioRmHTPLVjhcEtx16mDshgfJdDqT8yfP7jEHE9Ah55V9dPWSMpzaMILhtwMPUyQmkEsVvCslfGsRJ/Au0p/OxrxrkqSUrCG5L2DCpUQJDicKlXPna6OxG52gfJ7LTo5C9Lh/5V+21NBVAcDWBhexhAgsW7J127Ksv30HMnzaIy8tMoeXp3MzbDfLUsBUEt2FUGNgugaF4YRFzefc9rV0tdfN5kxDbmdzMJ9Vp6ldCcPUzRoVxBBZd4r45dEj86zX7d/wz5fFLJrLTuWjbt1rp1IIQ3E6RRp0jCKSSxav8T56F5ERT0AjR/R6V7PW52Z29umULABDcFqBhihoCqXk7TxUv7N9HaJ4aRSUqPyHy/BMW1itR0ySC4GoCC9nGCaQSxetFZCUxTW18lvaR95UGSvb6zbN/qb1SCwUQ3BagYYp6AouTu99Z8ry7mSmqXr1lxSeJxXaysU0tK2iaiOBqAgvZ1ggYeKUNEuLbX5kaskdGZvy2tVWpn4XgqmcKxTYJ+KcLesL3CNEFbUqpnP5v1fsb7VAp2qoWgtsqOczTTsBKFm4l4Ru0F2qigDB/NZOdaROx9jsZTmYLwW2iaRjaeQJDyd0fYvH8C8IFd0eFo5f9EHlkO1ujj3SeSKUighsUedRtioCVdO8moaubmqRxsBAdCgnZ6Xz0Fo1lakojuEFQR82WCFhJN0ZC9xLR21sS0DJJtlXuLjj7u1rka4giuJ2kjVpKCAwlCmuZOKVETImI/IaFl6fz0TuVyDUgguA2AAlDzCNgJdz5ROXd9y0GuRshCttObsaPdHtCcHUThr5GAsJWorjRqGs8Cz3PxHY6H1mtceH4cEonXGh3hoCVKFwhxPcx0XGdqdhQlUxJxF6fj/20odFNDsKO2yQwDDeTwJWzdh4bPibs774JYxwKPcPMy9O5iO9L6QPBVYoTYkETSMWLnxKWVYZ91fktb4DsdZuj/o3KlDwQXCUYIWISgdSch0+SgYMbiSRikK8nmMRO52JbVHhCcFVQhIaRBIbi7nXMdIdJ5oTk716Z+oI9MnLZq+34QnDboYe5xhOw5m8/nUuDG8w6YUG+Ewrx8rVbom6rABHcVslhXlcRsOKFG4k5kJ8n1gTFfLOTjaxoBSSC2wo1zOlKAql57tni8QYiOc+cBXCRQ2Snt0T2NuOp6eAujhcv8cg7T4jPZf+MDaZ3NFMQY0EABI4i8Jow2Zls9NZG2TQc3CWzd5xQmjJwGxFZjYpjHAiAQFMEch7TsnXZ6BP1ZjUU3KH4rghzqOU30vVM4HkQAIExAr8gkcvr3ZysbnCrV5/PACwIgEDnCHgs71mXjT1eq+KkwV04Z9tbBwemPNc5u6gEAiBQJfDKAW//Wzdsjb8wEZFJg2vFCzuIeTZQggAIBELgn51c9GNNBTeVKMwT4gcDsYuiIAACZQIDTCevzkZ/8XocNXfcobj7JWb6G/ADARAIkoC3aKLbodQObqKwgYk/EaRl1AaBfifARKvSuehnGt5xrbj7NDGd1e/gsH4QCJQA03edbPRPGw9uovgKkUwL1DSKgwAIkJOLHvXKuOZLZStR/E8i+WNwAwEQCI6AEH07k4v+eTM7bpZIzLkMSHDsUBkEAiTAX3dykS81EVz3HiL6bICOURoE+p6AsMQz2djWhoObihdTwrK278kBAAgERUDomSnT5L2rRmIvNhxcf6CVcP+JiC4NyjfqgkA/ExD25mWys7ITMah7koGVcP1r40ztZ4BYOwh0moCId0smP+vLterWDW5q3u4/E8/7TqeNox4I9DOBib4CGs+jbnD9wVdc/MibpoRe20RE0/sZJtYOAh0gMOLkopfVq9NQcEdFrKR7Gwl9oZ4ongcBEGiOABM9Ksy3O9nISCMzmwpu+QOrubvOpzBPJ+KPVHfg46uFZKwgk1D5v/x/8OH/T0JMLF51IDMLydjT1T8qY46YNCpclvP1KvJcKXBUHa7WH6tT9nB0nbLWYTPjx1R9v66O76pcv/Lwffq6vkTlb/8xJjhuCYeLV3hUn/J9lqdU64zTri6qUod9ZlKWLq9tbM3lZ+vXGbf48brVRYwxqNSp+D+8nvJ/VH2OLXxczcPrHp1T4TF+zUcYHncMeOW1jRt5RJOO0PA9lK1JZU6V9JFjRr0cZlVZTeWYGjs+x3sbOwaqfRvrweE55fWMZzA2xjvieB7vrXJQjD/uxh8f/t/8Eon3PWH6waBHT63eGvvhOH91/2w6uHUVMQAEQEA7AQRXO2IUAAH1BBBc9UyhCALaCSC42hGjAAioJ4DgqmcKRRDQTgDB1Y4YBUBAPQEEVz1TKIKAdgIIrnbEKAAC6gkguOqZQhEEtBNAcLUjRgEQUE8AwVXPFIogoJ0AgqsdMQqAgHoCCK56plAEAe0EEFztiFEABNQTQHDVM4UiCGgngOBqR4wCIKCeAIKrnikUQUA7AQRXO2IUAAH1BBBc9UyhCALaCSC42hGjAAioJ4DgqmcKRRDQTgDB1Y4YBUBAPQEEVz1TKIKAdgIIrnbEKAAC6gkguOqZQhEEtBNAcLUjRgEQUE8AwVXPFIogoJ0AgqsdMQqAgHoCCK56plAEAe0EEFztiFEABNQTQHDVM4UiCGgngOBqR4wCIKCeAIKrnikUQUA7AQRXO2IUAAH1BBBc9UyhCALaCSC42hGjAAioJ4DgqmcKRRDQTgDB1Y4YBUBAPQEEVz1TKIKAdgIIrnbEKAAC6gkguOqZQhEEtBNAcLUjRgEQUE+g6eBa8wrnsNCFIqELieRCInqbeltQBIEeJyD0ayLaLkx7QiF6NL0l+lQzK244uNfO2XbMSwNTvklEn22mAMaCAAg0QoA3lF47tHT9rtkvNzS6kUGpePE9wrKViE5uZDzGgAAItEBA6EURb1Fm66xsvdl1d1wrXriBmG+tJ4TnQQAE1BBg4cXpfCQ9mdqkwbXiu+cSe/5OiwcIgEAHCQwMhk9dvWnGz2qVrBlca/7206k0+BgR/V4H/aIUCIBAhcCIk4te1nxwE+5mIpoPiiAAAgERELnZycdWTFS99o6bcP+HiP4gIMsoCwJ9T0CENmfy0Y82HNzFF7tv90L0TN+TAwAQCJKA0DNOPnpmw8FNJdy4EOWC9IzaIAACRN4Anbhuc/RXr2cx4UtlK15YQcw3ARwIgEDABERmOPnYQw0FdyjpLmWh+wK2jPIg0PcEmtpx8VK5748XADCBQLPvcZdGC797YBrvM8E7PIBAvxJo+lNlH5SVcO8los/0KzSsGwQCJ9DS97jxXXOJQ/i5Y+Ddg4E+JdDaL6fKuy4+Xe7TYwbLDppAy79VHjVuJdwHiGhB0AtBfRDoFwJtnx2E8PbLoYJ1GkFA5fm4owtKJdw7hOg6IxYIEyDQcwQ0XAFjbOdNFheQ0DCRvKvnuGFBINBJAp265tTompZ+9OHfP3DwwEoiWtLJddarJcTLMrnI1+qNw/Mg0AsE6l66ptYirUTRIpJhIjrVGBDMe0ty6JPrc7OfNcYTjICABgItB9f3siS540xPwsNC/AkN3lqWFKFrMvnoPS0LYCIIGE6greCOvfdNuP4lW/3d983mrFe2hQ+Urlyz8yL/+rV4gEBPEVASXJ/IoqR7LnuykpmTZhEKLXRyMzeY5QluQKA9AsqCO7b7Vi7n6u++U9uzpnK2bKCXBpY4D83Yr1IVWiAQFAHlwS3vvnH3AiYaZqZoUAuboO4+ktBCJz9zm0GeYAUEWiKgJbiHd9/iTcQy4VXqWnKrYhLTPU42eo0KKWiAQFAEtAbXX9RQfHeEQzJMIh8MapET1H2WQ/zJ9JbIXoM8wQoINExAe3B9J9b0PVPpjaVhErqhYWcdGMgkX0vnYss6UAolQEApgY4Ed9TxUHJXkiXkf3B1ntJVtCEmRI9zOLzYeXDGf7Qhg6kg0FECHQ2uv7Ils3ecUDpmwN99r+7oSusUE6brM9nobSZ5ghcQqEWg48EdNWIl3csrJyzQHxrUnt3eAF21bnP0vwzyBCsgcBSBwILrO0nN23mqeGE/vJZJvRGiT2Vy0TUmeYIXEBhPINDgjr33TbhL/O99zbpXkWzikPf59JbZz+GQAQHTCBgRXB/K4uTud4rIsJDUvLVgAPD2C3mLM7lZGwOojZIgUJOAMcEde++bKF5bOWFBjjeob2u8AfriRPdwMcgjrPQRAeOC67Nfkiy8uyS0kogvNqYXTM+zyFXpXGyLMZ5gpG8JGBncsd03XrixesLCoCkdYqHbfjvtd5aPjHzwVVM8wUf/ETA6uOX3vvHChcI8LEQzTGkPE/1QmD7nZKMFUzzBR38RMD64h9/7uv6nzstNao//SXg6F8XtSE1qSp946ZrgVnbf4iyPxb9Q3fuN6Q/zXiH+60x25r8Y4wlGep5AVwXX78aVs3YeG54a9n8y+QWzusM3OrnI35rlCW56lUDXBXe0EYvixUuYaZhJ/sSc5si2MNOyNdnY4+Z4gpNeJNC1wfWbkZrz8EkyeNA/1/cvzGoOX+fkIneZ5QlueolAVwd3tBFDSXchiaxk4jNMaQ4TP8DM9trszKdN8QQfvUOgJ4Lrt8Oav/10Kg0ME/GVBrVnnxBdjxMWDOpIj1jpmeCO232XcuV0wbeY0yN2SuLdtD4f+6k5nuCkmwn0XHDL733nuWeLVw7vpQY151kiWebkYrjGs0FN6VYrPRnc0WZYieLnhfz3vnScKQ0Skn84QAP2xtyM/zPFE3x0H4GeDm75vW/CfV/19igXGdSeHxCR7eSiDxrkCVa6iEDPB3fsvW+i+BWu3F0wZEp//BMWBvlVe1Uu8YopnuCjOwj0TXDL730Tuz4iVL7K5IeNaY/IY0IhO5OP7DLGE4wYT6Cvgut3Y8GCB8LH7j/BD++XDevOSicXtQ3zBDuGEui74I59cBXfNZf83ZfpvQb1ZsTJRU26dI9BaGBlPIG+Da4PYeGcbW8cDE/xw/s5gw4LhNegZphqpa+DO9qUVNz9GDH5J+v/kSGNQngNaYSpNhDcamesuXtOpgHPP2Hh02Y0SxbixxpmdMJEFwju67qSSrpDUvnJ5NsCbthWJxeNB+wB5Q0lgOBO0JihOcV38ED5ErFXBNq38MEznAfn/CRQDyhuJAEEd5K2pJKFq0jKF6o7MZDuidzs5GNm3Rg8EBAo+noCCG6dY8KaVziHPPZfOs/v+OGD4HYcebcURHAb7NRQ0v0rEvJPWJjW4JT2hyG47TPsUQUEt4nGWonCB4jKu2+siWmtD0VwW2fX4zMR3BYaPJRwbSa6uYWpzU1BcJvj1UejEdwWm51KFGdK5eZkH2pRov40fKpcn1GfjkBw22j8ggVPTjl2///64f1iGzK1puJ7XA1Qe0USwVXQSSu+M1E5YYHPVyBXlcAvp9Sx7D0lBFdRT6+4OP+mQT5mmJmvaVtS+DEnH/lA2zoQ6FkCCK7i1qbi7sclRP4tUs5qTZqfdHIRg+7O0NoqMEsvAQRXA99F8eIpoZD44V3cpPyDHKKvpLdEn2pyHob3GQEEV2PDy588i3c5MV9ORG+YpNTTRHKvk4v9vUY7kO4hAghuB5q5ZG7xtNKAXECevIuIzySWk4j45yL0PAttd7ZGH+mADZToIQIIbg81E0vpHwIIbv/0GivtIQIIbg81E0vpHwIIbv/0GivtIQIIbg81E0vpHwL/D9sONRT1NKg1AAAAAElFTkSuQmCC"></div>
        <div >{{ exchangeRate.toFixed(3) }}&nbsp;{{ coinCode1 }}</div>
      </van-col>
    </van-row>

    <van-divider />

    <van-row class="exchange_rate">
      <van-col span="18">
        <span style="font-size: 0.3rem; color: rgb(115, 122, 153);">{{$t('hj44')}}</span>
      </van-col>
      <van-col span="5" style="font-size: 0.3rem; display: flex; justify-content: flex-end; color: rgb(115, 122, 153);">
        <span >0.00</span>
      </van-col>
    </van-row>

    <van-row class="exchange_button">
      <van-button @click="exchange" type="primary" style="color: white; background: rgb(95, 77, 188); border-color: rgb(95, 77, 188);">{{ $t("hj331") }}</van-button>
    </van-row>

    <div class="user-tips">
      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAzVJREFUWEfFl09IVFEUxr/jn4aaOyEp2XtKYLVMCoLADIxa9GdhtWikFrVt3kTkosJs4aKUamFE86ZtLYpsUbnIWhQJqRAERS1LQXQmRUOaO8Wkzok3ar0Z35t3HQXf9p3z3d+557x7v0dY5YdWeX0oA0ze2bA+VZqqA6MBoAYiVIJRmSmAMMaMMYB7Qej1TfsGys//+KlSnBLAaEQYRLgMYLOKKIBhZtyoCkvTKz4vALehJL4x0A3wYS8h5/fUo40nGqkNM275rgDxqAgy43FhC2dnEaFJC8kuJy1HgJGo2F/EeL0Siy9opAkHqkPyTa7mIoCuLhTvnRCuW2YJ6IZ0BI+ZgvNBv6uQJcEgZu0xi4RGTf9NAl3MJ1REqN0Ukl/sMd+jYnua8TlfHoNvVRnJS64AI1ERLFLoOzOfqgonH9mFRiP+k0T00KttaUJTtW0e/u3AUGdZmc838wHAFi8RAO26IVvtcTFTXAdwRSF3MJUq2VXTPDU1d4TMPzEzcAzgpwoCVlK3Zsij9ti4KZ4z0KiSD9Bx3Ug8ywEQnQAuKAkwD+nhZNZOxSL+QRDVKOUDt3VDNucC9AHYoygArUKuoyB+W/HchbXxCfFLNRdAv27I+iyAeFR8ZcZWVZHiIt5ZeTb5yYofu+ffMZumj6q5RPimheS2bABTJBgQyiJAUDPkEys+booTDDiedE56BEjNkIFlAYBxVQ9La/IRi4hWEK4tAd4BYIktANMDPZw4MwcQuA/i08oATi2ImWJJQ0iEAS0kM0Mbj4p+ZtSpAjgOYcz0twPUsgSRSWbczfSRcA5AuXoud+hGMnNo/T+Iov6DYHqpLrKMSOJDeij5KgsgY7lK/liXiZLryb0RvW5CG+6wb2ZN7YJly7oN561XRKW2QgGYEbZbtUXXccwMvFCxYIUBUI9uJI7YC1wEMOcDxbTXLhQCoI3L0lx/6OhsVtIPLhTi5gtdTelK+kI3P5j1FThtueUP6yf8HV4Wza1dlgXrq0i25PrAvDPgJDZv1ToU3ZIlMZgmtNitlxuk0p+RlTxn2Wb3AdwAYLfzrxneA9SbShW/XbBcXsOsDOAlVOj7VQf4CyBmOTDxzWJKAAAAAElFTkSuQmCC" class="user-tips-icon">
      <p class="user-tips-text">{{$t('hj304')}}</p>
    </div>
<!--    end-->
  </div>
</template>

<script>
// import '@/assets/style/common.less'
import * as api from '@/axios/api'
import { Toast } from 'mint-ui'
import {getStockCoinList, transfer} from "../../axios/api";

export default {
  components: {
  },
  data() {
    return {
      selected: '1', // 选中
      form: {
        account1: '',
        account2: '',
        account3: '',
        account4: '',
        password: ''
      },
      userInfo: {
        realName: ''
      },
      showPopover: false,
      showPopover1: false,
      // 通过 actions 属性来定义菜单选项
      actions: [],
      actions1: [],
      coinImg: "http://i.exgco.com/exgco/d0251b7a-3ad5-4ad2-83aa-4d0d3e877556.png",
      coinCode: "USD",
      coinImg1: "https://wise.com/public-resources/assets/flags/rectangle/hkd.png",
      coinCode1: "HKD",
      coinList:  [],
      exchangeRate: 0.000, //汇率
      buyMoney: 0.000, //买入余额
      sellMoney: 0.000, //卖出余额
      sellVal:"", //兑换金额
      buyVal:"",
    }
  },
  computed: {},
  created() {
    this.getUserInfo()
    this.getProductSetting()
    this.getStockCoinList()
  },
  filters: {
    formatDecimal(value) {
      if (typeof value === 'number') {
        return value.toFixed(3); // 使用 toFixed 方法保留 3 位小数
      }
      return value;
    }
  },
  watch: {
    userInfo(e) {
      this.$nextTick(()=>{
        //初始化默认 美国跟香港的金额
        this.buyMoney = e.usEnableAmt;
        this.sellMoney = e.hkEnableAmt;
      })
    },
    coinList(e){
      this.$nextTick(()=>{
          //渲染窗口1
          this.actions = this.coinList.map((coin) => {
            return { text: coin.coinCode, icon: coin.icoImg, id:coin.id,coinName:coin.coinName,defaultRate:coin.defaultRate,isUse:coin.isUse };
          });
          //渲染窗口2 去掉第一个窗口的选中
          this.actions1 = [];
          this.coinList.forEach((coin) => {
            if (coin.coinCode !== "USD") {
              this.actions1.push({
                text: coin.coinCode,
                icon: coin.icoImg,
                id: coin.id,
                coinName: coin.coinName,
                defaultRate: coin.defaultRate,
                isUse: coin.isUse
              });
            }
          });
          //初始化默认汇率
          this.exchangeRate = this.findByCodeRate("HKD");
      })
      deep: true
    }
  },
  mounted() {
    if (this.$route.query.type) {
      this.selected = this.$route.query.type + ''
    }
  },
  methods: {
    async exchange() {
      //开始兑换
      let opt = {
        formAmount: this.buyVal,
        toAmt: this.sellVal,
        formCode: this.coinCode,
        toCode: this.coinCode1,
      }
      let data = await api.transfer(opt)
      console.log(data)
      if (data.status === 0) {
        this.$message.success(this.$t('hj271'));
        //跳转到我的
        this.$router.push('/user');
      } else {
        this.$message.error(data.msg)
      }

    },
    buyInput(event){
      var value = event.target.value;
      if(value === ""){
        this.sellVal = "";
        this.buyVal = "";
        return false;
      }
      //输入框
      this.sellVal = parseFloat(value * this.exchangeRate).toFixed(3);
      this.buyVal = value;
    },
    onSelect1(action){
      //兑换窗口2
      this.coinImg1 = action.icon;
      this.coinCode1 = action.text;

      var rate1 = this.findByCodeRate(action.text);
      var rate2 = this.findByCodeRate(this.coinCode);
      console.log(rate1 + "/" + rate2);
      this.exchangeRate = rate1 / rate2;

      //额度变化
      this.buyMoney = this.findByCodeMoney(this.coinCode);
      this.sellMoney = this.findByCodeMoney(action.text);

      this.sellVal = parseFloat(this.buyVal * this.exchangeRate).toFixed(3);

      console.log(action)
    },
    onSelect(action) {

      //窗口互换
      this.coinImg1 = this.coinImg;
      this.coinCode1 = this.coinCode;

      //汇率显示 窗口2  / 窗口1
      var rate1 = this.findByCodeRate(this.coinCode1);
      var rate2 = this.findByCodeRate(action.text);
      console.log(rate1 + "/" + rate2);
      this.exchangeRate = rate1 / rate2;
      //end

      //兑换窗口1
      this.coinImg = action.icon;
      this.coinCode = action.text;

      //去除第一个货币的选项
      this.actions1 = [];
      this.coinList.forEach((coin) => {
        if (coin.coinCode !== action.text) {
          this.actions1.push({
            text: coin.coinCode,
            icon: coin.icoImg,
            id: coin.id,
            coinName: coin.coinName,
            defaultRate: coin.defaultRate,
            isUse: coin.isUse
          });
        }
      });

      this.buyMoney = this.findByCodeMoney(action.text);
      this.sellMoney = this.findByCodeMoney(this.coinCode1);

      this.sellVal = parseFloat(this.buyVal * this.exchangeRate).toFixed(3);
      //end
      console.log(action)
    },
    findByCodeMoney(code){
      //根据货币类型返回额度
      var result = 0.000;
      switch (code) {
        case "USD" : result = this.userInfo.usEnableAmt; break;
        case "JPY" : result = this.userInfo.jpEnableAmt; break;
        case "HKD" : result = this.userInfo.hkEnableAmt; break;
        case "MYR" : result = this.userInfo.myEnableAmt; break;
        case "THB" : result = this.userInfo.thEnableAmt; break;
        case "PHP" : result = this.userInfo.phEnableAmt; break;
        case "IDR" : result = this.userInfo.idEnableAmt; break;
        case "KRW" : result = this.userInfo.krEnableAmt; break;
        case "INR" : result = this.userInfo.inEnableAmt; break;
      }
      return result;
    },
    findByCodeRate(code){
      //根据code返回汇率
      var hv = 0;
      this.coinList.forEach((coin) => {
        if (coin.coinCode === code) {
          hv = coin.defaultRate;
        }
      });
      return hv;
    },
    async getProductSetting() {
      let data = await api.getProductSetting()
      console.log(data)
      if (data.status === 0) {
        this.$store.state.settingForm = data.data
        if (!this.$store.state.settingForm.indexDisplay) {
          this.selected = '3'
        }
      } else {
        this.$message.error(data.msg)
      }
    },
    async getStockCoinList() {
      let data = await api.getStockCoinList()
      console.log(data)
      if (data.status === 0) {
        this.coinList = data.data;
      } else {
        this.$message.error(data.msg)
      }
    },
    handleBackClick() {
      this.$router.go(-1);
    },
    selectAll1() {
      // 选择全部
      this.form.account1 = this.$store.state.userInfo.enableAmt
    },
    selectAll2() {
      // 选择全部
      this.form.account2 = this.$store.state.userInfo.enableIndexAmt
    },
    selectAll3() {
      // 选择全部
      this.form.account3 = this.$store.state.userInfo.enableAmt
    },
    selectAll4() {
      // 选择全部
      this.form.account4 = this.$store.state.userInfo.enableFuturesAmt
    },
    async tosubmit() {
      // 融资转指数
      let opt = {
        amt: this.selected === '1' ? this.form.account1 : this.selected === '2' ? this.form.account2 : this.selected === '3' ? this.form.account3 : this.form.account4,
        type: this.selected // 1 融资转指数 2 指数转融资
      }
      let data = await api.AmtChange(opt)
      if (data.status === 0) {
        Toast(data.msg)
        this.$router.push('/user')
      } else {
        Toast(data.msg)
      }
    },
    async getUserInfo() {
      // 获取用户信息
      let data = await api.getUserInfo()
      if (data.status === 0) {
        this.$store.state.userInfo = data.data
        this.userInfo = data.data;
      } else {
        Toast(data.msg)
      }
    }
  }
}
</script>


<style lang="less" scoped>
.header {
  width: 100%;
  height: 1.5rem;
  background: #fff;
  position: fixed;
  z-index: 999;
  border-radius: 0 0 .15rem .15rem;

  .left_back {
    width: 1rem;
    height: 100%;
    left: 0;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;

    img {
      width: .6rem;
      height: .6rem;
    }
  }

  .header_titles {
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: .4615rem;
    line-height: 1.5rem;

    span {
      font-weight: 600;
    }
  }
}

.form-block {
  width: 100%;
  height: 1.5rem;
  margin-top: .3rem;
}

/deep/ .mint-field-other {
  padding-right: .3rem;
}

/deep/ .mint-cell-wrapper {
  height: 100%;
  border: none;
  background: rgb(245, 245, 245);
  border-radius: .15rem;
}

.is-selected {
  background: rgb(235, 235, 235) !important;
  border-radius: .15rem;
}

.mint-navbar {
  padding: 0 .3rem;
}

.btnbox {
  width: 94%;
  margin-top: .1rem;
}

.loginout {
  height: 1.2rem !important;
  line-height: 1.2rem !important;
}

.int-cell {
  width: 100%;
  height: 100%;
}

a {
  width: 100%;
  height: 100%;

  .mint-cell-wrapper {
    width: 100%;
    height: 100%;
  }
}

.bars {
  width: 100%;
  height: 6rem;
  display: flex;
  padding: 0 .3rem;
  align-items: flex-end;

  >div {
    margin-bottom: 1.2rem;
    font-size: .65rem;

    span {
      font-weight: 600;
    }
  }
}

.mint-cell.mint-field {
  background: #fff !important;
  color: #000 !important;
}

/deep/ .mint-cell-text {
  color: #000 !important;
}

.text-center.btnok {
  display: inline-block;
  height: 1rem;
  line-height: 1rem;
  background: #2d6ae9;
  border: none;
  border-radius: .1rem;
}

.wrapper {
  width: 100%;
  height: 100%;
  background: rgb(241,242,246);
}

/deep/.mint-cell-wrapper {

  span {
    font-size: 0.35rem !important;
  }

  /deep/input {
    font-size: 0.35rem !important;
  }
}

/deep/.mint-cell-value {
  font-size: 0.35rem !important;
}

/deep/.mint-tab-item-label {
  font-size: 0.35rem !important;
}

/deep/.loginout {
  font-size: 0.35rem !important;
}


.top_icon {
  width: 100%;
  height: 1.3rem;
  display: flex;
  justify-content: space-between;
  align-items: center;

  .left_back {
    width: 10%;
    height: 50%;
    display: flex;
    align-items: center;
    justify-content: center;

    img {
      width: 0.6rem;
      height: 0.6rem;
    }
  }

  .title {
    width: calc(100% + 2rem);
    text-align: center;
    font-size: 0.4rem;
  }

  .right_icon {
    width: auto;
    height: 35%;
    padding-right: 0.1rem;
    display: flex;
    justify-content: space-between;

    > div {
      width: auto;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;

      img {
        width: 0.55rem;
        height: 0.55rem;
      }
    }
  }
}


.texBoxConver {
  background-color: #FAFAFC;
  border: 0.018519rem solid #E8E9F2;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  border-radius: 1rem;
  position: relative;
  display: flex;
  justify-content: space-around;
  align-items: center;

  .van-popover__wrapper {
    height: 1.4rem;
    margin-top: 0.2rem;
    margin-bottom: 0.2rem;
    width: 3.2rem;
    margin-left: 0.2rem;
    border-radius: 2rem;
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: space-around;
    border: 0.027778rem solid #EFF0FA;
  }

  .texBoxConver_left {
    border: 0.027778rem solid #EFF0FA;
    border-radius: 50%;
    width: 1rem;
    height: 1rem;
    display: flex;
    justify-content: space-around;
    align-items: center;

    img {
      width: 0.5rem;
      height: 0.5rem;
      border-radius: 50%;
    }
  }

  .texBoxConver_right {
    margin-right: 0.2rem;

    span {
      font-size: 0.4rem;
      margin-right: 0.1rem;
    }

    img {
      width: 0.3rem;
      height: 0.3rem;
    }
  }

  .texBoxConver_content {
    width: auto;
    position: absolute;
    top: 0.2rem;
    right: 1.8rem;
  }

  .input_num {
    width: 3.6rem;
    height: 1rem;
    display: flex;
    justify-content: start;

    input {
      display: flex;
      justify-content: end;
      font-size: 0.5rem;
      width: 100%;
      text-align: right;
    }
  }
}

.arrow_split_down {
  display: flex;
  justify-content: center;
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;

  img {
    border: 0.027778rem solid #DBDCE5;
    width: 0.6rem;
    height: 0.6rem;
    border-radius: 50%;
  }
}

.exchange_rate {
  margin-left: 0.3rem;
  margin-right: 0.3rem;
  align-items: center;
  margin-top: 0.5rem;

  .exchange_rate_col_two {
    display: flex;
    justify-content: space-around;
    align-items: center;
    font-size: 0.35rem;

    .exchange_rate_col_two_divImg {
      width: 0.45rem;
      height: 0.5rem;
      background-color: #EBEBFF;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;

      img {
        width: 0.3rem;
        height: 0.3rem;
      }
    }
  }
}

.exchange_button {
  margin-top: 0.6rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  height: 1.3rem;

  button {
    width: 100%;
    height: 100%;
    border-radius: 25rem;
    font-size: 0.45rem;
  }
}

.user-tips {
  margin-top: 0.7rem;
  padding: 0.5rem;
  position: relative;

  .user-tips-icon {
    width: 0.6rem;
    height: 0.6rem;
    position: absolute;
  }

  .user-tips-text {
    font-size: 0.35rem;
    line-height: 0.65rem;
    color: gray;
    text-indent: 0.8rem;
  }
}

</style>
